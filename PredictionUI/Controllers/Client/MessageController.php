<?php
	namespace Controller\Client;
    use BerkaPhp\Controller\BerkaPhpController;
    use BerkaPhp\Helper\Auth;
    use BerkaPhp\Helper\Check;
    use BerkaPhp\Helper\DateTime;
    use BerkaPhp\Helper\Debug;
    use BerkaPhp\Helper\Html;
    use BrkORM\T;
    use Util\ISendHelper;
    use Util\Request;

    class MessageController extends BerkaPhpController
	{

		function __construct() {
			parent::__construct();
            $this->view->set('breadcrumb', 'Message');
		}

		function index() {

            $messages = T::Find('message')
                ->Join(['message_status'=>'status'], 'status.messageStatusId = message.messageStatusId', 'LEFT JOIN')
                ->Join('contact', 'contact.contactId = message.contactId')
                ->Join(['message_type'=>'type'], 'type.messageTypeId = message.messageTypeId', 'LEFT JOIN')
                ->Where('message.userId', '=', Auth::GetActiveUser(false)->id)
                ->OrderBy('message.createdDate','DESC')
                ->FetchList();

            $contacts = T::Find('contact')
                ->Where('userId', '=', Auth::GetActiveUser(false)->id)
                ->Where('IsDeleted', '=', Check::$False)
                ->OrderBy('name','DESC')
                ->FetchList();

            $messageTypes = T::Find('message_type')
                ->Where('IsDeleted', '=', Check::$False)
                ->FetchList();

            $startDate = null;
            $endDate = null;

            if(!empty($data['StartDate'])) {
                $startDate = DateTime::toDate($data['StartDate'], DATE_FORMAT);
            }

            if(!empty($data['EndDate'])) {
                $endDate = DateTime::toDate($data['EndDate'], DATE_FORMAT);
            }

            $this->view->set('contacts', $contacts);
            $this->view->set('messageTypes', $messageTypes);
            $this->view->set('EndDate', $endDate);
            $this->view->set('StartDate', $startDate);
            $this->view->set('messages', $messages);
            $this->view->set('menuTitle', 'All');
            $this->view->render();

		}

        function add() {

            if(Request::IsPost()) {

                $count = 0;
                $data = Request::GetData();

                $messageStatus = T::Find('message_status')
                    ->Where('Code', '=', 'PNG')
                    ->Where('isDeleted', '=', Check::$False)
                    ->FetchFirstOrDefault();

                $contactIds = $data['contactId'];

                foreach ($contactIds as $contactId ) {

                    $message = T::Create('message');
                    $message->SetProperties($data);
                    $message->contactId = $contactId;
                    $message->userId = Auth::GetActiveUser(false)->id;
                    $message->createdBy = Auth::GetActiveUser(false)->id;
                    $message->createdDate = DATE_NOW;
                    $message->messageStatusId = $messageStatus->messageStatusId;
                    $message->content = $message->contentTemplate;
                    $message->isViewed = Check::$True;

                    if ($message->Save())
                        $count++;

                }

                if ($count > 0) {
                    return $this->jsonFormat(['success'=> true, 'message'=> '('. $count . ') Message/s has been saved, and it will be processed shortly', 'error'=>false, 'link'=>Html::action('/message')]);
                } else {
                    return $this->jsonFormat(['error'=> true, 'message'=>'Message could not be saved, try again.', 'success'=>false]);
                }
            }
            else {

                $contacts = T::Find('contact')
                    ->Where('userId', '=', Auth::GetActiveUser(false)->id)
                    ->Where('IsDeleted', '=', Check::$False)
                    ->OrderBy('name','DESC')
                    ->FetchList();

                $messageTypes = T::Find('message_type')
                    ->Where('isDeleted', '=', Check::$False)
                    ->Where('display', '=', Check::$True)
                    ->FetchList();

                $this->view->set('contacts', $contacts);
                $this->view->set('messageTypes', $messageTypes);
                $this->view->set('menuTitle', 'New');
                $this->view->render();
            }

        }

        function view($option) {

            $id = $option['args']['query']['id'];

            $message = T::Find('message')
                ->Join(['message_status'=>'status'], 'status.messageStatusId = message.messageStatusId', 'LEFT JOIN')
                ->Join('contact', 'contact.contactId = message.contactId')
                ->Join(['message_type'=>'type'], 'type.messageTypeId = message.messageTypeId', 'LEFT JOIN')
                ->Where('message.userId', '=', Auth::GetActiveUser(false)->id)
                ->Where('message.messageId', '=', $id)
                ->FetchFirstOrDefault();

            $logs = T::Find('log')
                ->Where('isDeleted', '=', Check::$False)
                ->Where('isAdvanceLog', '=', Check::$False)
                ->Where('log.messageId', '=', $message->messageId)
                ->FetchList();

            if($message->type->code =='SMSRP' && $message->isViewed == Check::$False) {
                $message->isViewed = Check::$True;
                $message->Save();
            }

            $this->view->set('menuTitle', 'Log');
            $this->view->set('msLogs', $logs);
            $this->view->set('smessage', $message);
            $this->view->render();

        }




	}

?>