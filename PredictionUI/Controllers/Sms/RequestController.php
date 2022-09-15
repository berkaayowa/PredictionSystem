<?php
	namespace Controller\Sms;
    use BerkaPhp\Helper\Auth;
    use BerkaPhp\Helper\Check;
    use BerkaPhp\Helper\Debug;
    use BrkORM\T;
    use Controller\RestfulApiController;
    use Util\Request;
    use Util\SMS;


    class RequestController extends RestfulApiController
	{

		function __construct() {
			parent::__construct();
		}

        function test() {

            if(sizeof($_POST) == 0)
                return self::Response(['error'=>true, 'message'=>'invalid method or empty argument']);
            else
                var_dump($_POST);

            return Request::Response(['error'=>true, 'message'=>'"message length" can not be more than 35 characters']);
        }

		function send() {

            Request::Post(function($data){
                if(!isset($data['authkey']))
                    return Request::Response(['error'=>true, 'message'=>'"authkey" is required']);
                return true;

            }, function($data) {

                $result = [];

                $auth = T::Find('user')
                    ->Where('authKey', '=', $data['authkey'])
                    ->Join('status', 'status.id = user.refStatusId')
                    ->FetchFirstOrDefault();

                if(!$auth->IsAny())
                    return Request::Response(['error'=>true, 'message'=>'invalid user authkey']);

                $data = Request::GetData();

                $messageStatus = T::Find('message_status')
                    ->Where('Code', '=', 'PNG')
                    ->Where('isDeleted', '=', Check::$False)
                    ->FetchFirstOrDefault();

                $failMessageStatus = T::Find('message_status')
                    ->Where('Code', '=', 'FLD')
                    ->Where('isDeleted', '=', Check::$False)
                    ->FetchFirstOrDefault();

                $messageType = T::Find('message_type')
                    ->Where('isDeleted', '=', Check::$False)
                    ->Where('code', '=', 'SMS')
                    ->FetchFirstOrDefault();

                $contact = T::Find('contact')
                    ->Where('userId', '=', $auth->id)
                    ->Where('cellPhone', '=', $data['destination'])
                    ->Where('isDeleted', '=', Check::$False)
                    ->FetchFirstOrDefault();

                if(!$contact->IsAny()) {

                    $contact = T::Create('contact');
                    $contact->cellPhone = $data['destination'];
                    $contact->userId = $auth->id;
                    $contact->createdBy = $auth->id;
                    $contact->CreatedDate = DATE_NOW;
                    $contact->Save();

                }

                $message = T::Create('message');
                $message->userId = $auth->id;
                $message->createdBy = $auth->id;
                $message->messageStatusId = $messageStatus->messageStatusId;
                $message->contentTemplate = $data['message'];
                $message->content = $message->contentTemplate;
                $message->isViewed = Check::$True;
                $message->messageTypeId = $messageType->messageTypeId;
                $message->contactId = $contact->contactId;

                if(!isset($data['message']) || empty($data['message']))
                {
                    $message->messageStatusId = $failMessageStatus->messageStatusId;
                    $message->response = 'message is required';
                    $message->Save();
                    return Request::Response(['error'=>true, 'message'=>$message->response, 'reference'=>  $message->messageId]);
                }

                else if(!isset($data['destination']) || empty($data['destination']))
                {
                    $message->messageStatusId = $failMessageStatus->messageStatusId;
                    $message->response = 'destination is required';
                    $message->Save();
                    return Request::Response(['error'=>true, 'message'=>$message->response, 'reference'=>  $message->messageId]);

                }

                else if(count($data['message']) > 35)
                {
                    $message->messageStatusId = $failMessageStatus->messageStatusId;
                    $message->response = 'message length can not be more than 35 characters';
                    $message->Save();
                    return Request::Response(['error'=>true, 'message'=>$message->response, 'reference'=>  $message->messageId]);

                }

                if($auth->balance == 0 )
                {
                    $message->messageStatusId = $failMessageStatus->messageStatusId;
                    $message->response = 'insufficient balance';
                    $message->Save();
                    return Request::Response(['error'=>true, 'message'=>$message->response, 'reference'=>  $message->messageId]);
                }

                if(!$message->Save())
                    return Request::Response(['error'=>true, 'message'=>'system could not log you request urgently contact your support']);
                else {
                    return Request::Response(['response'=>['error'=>false, 'sent'=>true, 'reference'=> $message->messageId]]);
                }

            });
		}


	}

?>