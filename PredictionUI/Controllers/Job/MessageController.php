<?php
namespace Controller\Job;
use BerkaPhp\Helper\Check;
use BerkaPhp\Helper\Debug;
use BrkORM\T;
use Controller\RestfulApiController;
use Util\ISendHelper;
use Util\Request;
use Util\SMS;

class MessageController extends RestfulApiController
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

}

?>