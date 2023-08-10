<?php
namespace Controller\Job;
use BerkaPhp\Helper\Auth;
use BerkaPhp\Helper\Check;
use BerkaPhp\Helper\Debug;
use BrkORM\T;
use Controller\RestfulApiController;
use Util\ISendHelper;
use Util\Request;
use Util\SMS;

class PredictionController extends RestfulApiController
{

    function __construct() {
        parent::__construct();
    }

    function Process($option) {

        //http://localhost:8091/job/message/Process?code=run
        if(isset($option['args']) && isset($option['args']['query']) && isset($option['args']['query']['code'])) {

            $code = $option['args']['query']['code'];

            if($code == 'run') {

                $messages = T::Find('message')
                    ->Join(['message_status'=>'status'], 'status.messageStatusId = message.messageStatusId')
                    ->Where('message.isDeleted', '=', Check::$False)
                    ->Where('status.code', '=', 'PNG')
                    ->OrderBy('message.createdDate','DESC')
                    ->FetchList();

                foreach($messages as $message){

                    $message = T::Find('message')
                        ->Join('contact', 'contact.contactId = message.contactId')
                        ->Join(['message_type'=>'type'], 'type.messageTypeId = message.messageTypeId')
                        ->Where('message.messageId', '=', $message->messageId)
                        ->FetchFirstOrDefault();

                    if($message->IsAny()) {

                        $user = T::Find('user')
                            ->Where('user.id', '=', $message->userId)
                            ->FetchFirstOrDefault();

                        if ($message->type->code == 'SMS') {

                            $messageStatus = T::Find('message_status')
                                ->Where('isDeleted', '=', Check::$False);

                            ISendHelper::LogMessage($message->messageId, 'Checking Contents...');
                            $message->content = ISendHelper::ReplaceParameter($message);

                            if ($message->Save())
                                ISendHelper::LogMessage($message->messageId, 'Saved SMS contents...');
                            else
                                ISendHelper::LogMessage($message->messageId, 'SMS contents could not be saved (' . $message->content . ')');

                            ISendHelper::LogMessage($message->messageId, 'Evaluating parameters...');

                            ISendHelper::LogMessage($message->messageId, 'Started Processing SMS...');
                            $response = SMS::Send($message->contact->cellPhone, $message->content);
                            ISendHelper::LogMessage($message->messageId, 'Processing Completed...');

                            if ($response == null) {
                                $messageStatus->Where('Code', '=', 'FLD');
                                ISendHelper::LogMessage($message->messageId, 'Failed to send SMS');
                            }

                            if ($response != null) {

                                $message->response = json_encode($response);

                                $response = (array)$response;
                                $recipient = (array)$response['recipients'][0];

                                if (isset($recipient['creditCost'])) {
                                    $message->creditCost = $recipient['creditCost'];
                                    ISendHelper::LogMessage($message->messageId, 'SMS credits used ' . $message->creditCost);
                                }

                                if ($recipient['accepted'] == false || !empty($recipient['acceptError'])) {

                                    $messageStatus->Where('Code', '=', 'FLDUP');
                                    ISendHelper::LogMessage($message->messageId, 'SMS could not be successfully sent');
                                } else if ($response['statusCode'] === 200 && $recipient['accepted'] === true && empty($recipient['acceptError'])) {
                                    $messageStatus->Where('Code', '=', 'PSF');
                                    $message->thirdPartyReference = $recipient['apiMessageId'];
                                    ISendHelper::LogMessage($message->messageId, 'SMS successfully sent');
                                    $user->balance = $user->balance - $user->creditCost;

                                    if ($user->Save()) {
                                        ISendHelper::LogMessage($message->messageId, 'Balance updated');
                                    }

                                }

                            }

                            $messageStatus = $messageStatus->FetchFirstOrDefault();
                            $message->messageStatusId = $messageStatus->messageStatusId;

                            if ($message->Save()) {
                                ISendHelper::LogMessage($message->messageId, 'SMS status updated (' . $messageStatus->name . ')');
                            } else {
                                ISendHelper::LogMessage($message->messageId, 'SMS status could not be updated (' . $messageStatus->name . ')');
                            }

                        }

                    }

                }

            }
        }

    }

    function Reply($option) {

        //http://localhost:8091/job/message/reply?code=SMS
        if(isset($option['args']) && isset($option['args']['query']) && isset($option['args']['query']['code'])) {

            $code = $option['args']['query']['code'];

            if($code == 'SMS') {

                $data = Request::GetData();

                if(!empty($data['sentmessageid'])) {

                    $message = T::Find('message')
                        ->Join('contact', 'contact.contactId = message.contactId')
                        ->Join(['message_type'=>'type'], 'type.messageTypeId = message.messageTypeId')
                        ->Where('message.thirdPartyReference', '=', $data['sentmessageid'])
                        ->FetchFirstOrDefault();

                    if($message->IsAny()) {

                        if ($data['type'] == 'deliver') {

                            ISendHelper::LogMessage($message->messageId, 'Received reply');

                            $messageType = T::Find('message_type')
                                ->Where('isDeleted', '=', Check::$False)
                                ->Where('code', '=', 'SMSRP')
                                ->FetchFirstOrDefault();

                            $message->response = json_encode($data);
                            $message->creditCost = 0;
                            $message->messageId = 0;
                            $message->messageTypeId = $messageType->messageTypeId;
                            $message->content = $data['text'];
                            $message->createdDate = DATE_NOW;
                            $message->isViewed = Check::$False;

                            $messageStatus = T::Find('message_status')
                                ->Where('isDeleted', '=', Check::$False)
                                ->Where('code', '=', 'PSF')
                                ->FetchFirstOrDefault();

                            $message->messageStatusId = $messageStatus->messageStatusId;

                            $message->Save();

                            ISendHelper::LogMessage($message->messageId, 'Saved reply');
                        }
                        else if ($data['type'] == 'report') {

                            ISendHelper::LogMessage($message->messageId, 'SMS Delivered');

                            $messageStatus = T::Find('message_status')
                                ->Where('isDeleted', '=', Check::$False)
                                ->Where('code', '=', 'DLV')
                                ->FetchFirstOrDefault();

                            $message->messageStatusId = $messageStatus->messageStatusId;

                            if ($message->Save()) {
                                ISendHelper::LogMessage($message->messageId, 'SMS status updated (' . $messageStatus->name . ')');
                            } else {
                                ISendHelper::LogMessage($message->messageId, 'SMS status could not be updated (' . $messageStatus->name . ')');
                            }

                        }
                    }

                }

            }
        }

    }

    function request($option) {

        $requests = array();
        //http://localhost:8091/job/prediction/request?code=run
        if(isset($option['args']) && isset($option['args']['query']) && isset($option['args']['query']['code'])) {

            $code = $option['args']['query']['code'];

            if($code == 'run') {

                $requests = @T::Find('prediction_request')
                    ->Join(['prediction_request_status'=>'status'], 'status.id = prediction_request.predictionRequestStatusId')
                    ->Join(['prediction_contribution'=>'configuration'], 'configuration.id = prediction_request.predictionContributionId')
                    ->Where('status.code', '=', 'PG')
                    ->Where('prediction_request.isDeleted', '=', \Helper\Check::$False)
                    ->FetchList();

                $data = array();

                foreach ($requests as $request) {

                    $datRequest =
                        [
                            'id'=>$request->id, 'date'=>$request->requestedDate,
                            'configuration'=>[
                                'id'=> $request->configuration->id,
                                'leaguePointsPercentage'=> $request->configuration->leaguePointsPercentage,
                                'leaguePositionPercentage'=> $request->configuration->leaguePositionPercentage,
                                'head2headPercentage'=> $request->configuration->head2headPercentage,
                                'lastMatchPlayedPercentage'=> $request->configuration->lastMatchPlayedPercentage,
                                'awayHomePercentage'=> $request->configuration->awayHomePercentage,
                                'winDifference'=> $request->configuration->winDifference,
                                'winDrawDifference'=> $request->configuration->winDrawDifference,
                                'drawDifference'=> $request->configuration->drawDifference,
                                'numberOfHeadtohead'=> $request->configuration->numberOfHeadtohead,
                                'numberOfLastMatch'=> $request->configuration->numberOfLastMatch
                            ]
                        ];

                    array_push($data, $datRequest );

                }

                $requests = $data;

            }
        }

        return $this->jsonFormat(['error'=> sizeof($requests) == 0, 'data'=> $requests]);

    }

    function getleague($option) {

        $requests = array();
        //http://localhost:8091/job/prediction/getleague?code=run
        if(isset($option['args']) && isset($option['args']['query']) && isset($option['args']['query']['code'])) {

            $code = $option['args']['query']['code'];

            if($code == 'run') {

                $name = $option['args']['query']['name'];
                $country = $option['args']['query']['name'];

                $requests = @T::Find('league')
                    ->Join('country', 'country.id = league.countryId')
                    ->Where('league.name', '=', $name)
                    ->Where('league.isDeleted', '=', \Helper\Check::$False)
                    ->FetchFirstOrDefault();

            }
        }

        return $this->jsonFormat(['error'=> sizeof($requests) == 0, 'data'=> $requests]);

    }

    function updaterequest($option) {

        //http://localhost:8091/job/prediction/getleague?code=run
        if(isset($option['args']) && isset($option['args']['query']) && isset($option['args']['query']['code'])) {

            $code = $option['args']['query']['code'];

            if($code == 'run') {

                $statusCode = $option['args']['query']['statusCode'];
                $id = $option['args']['query']['id'];
                $filename = '';

                if(array_key_exists('filename', $option['args']['query']))
                    $filename =$option['args']['query']['filename'];

                $request = @T::Find('prediction_request')
                    ->Where('prediction_request.id', '=', $id)
                    ->Where('prediction_request.isDeleted', '=', \Helper\Check::$False)
                    ->FetchFirstOrDefault();

                if($request->IsAny()) {

                    $status = @T::Find('prediction_request_status')
                        ->Where('code' , '=', $statusCode)
                        ->Where('isDeleted', '=', \Helper\Check::$False)
                        ->FetchFirstOrDefault();

                    $request->predictionRequestStatusId = $status->id;
                    $request->modifiedDate = DATE_NOW;
                    $request->fileName = $filename;

                    if($request->Save())
                        return $this->jsonFormat(['error'=> false]);

                }

            }
        }

        return $this->jsonFormat(['error'=> true]);

    }

}

?>