<?php
	namespace Controller\Client;
    use BerkaPhp\Controller\BerkaPhpController;
    use BerkaPhp\Helper\Auth;
    use BerkaPhp\Helper\Check;
    use BerkaPhp\Helper\DateTime;
    use BerkaPhp\Helper\Debug;
    use BrkORM\T;

    class DashboardController extends BerkaPhpController
	{

		function __construct() {
			parent::__construct();
		}

		function index() {

            $data = [];
            $creditUsed = 0;

            $sentMessages = T::Find('message')
                ->Join(['message_status'=>'status'], 'status.messageStatusId = message.messageStatusId', 'LEFT JOIN')
                ->Join('contact', 'contact.contactId = message.contactId')
                ->Join(['message_type'=>'type'], 'type.messageTypeId = message.messageTypeId', 'LEFT JOIN')
                ->Where('message.userId', '=', Auth::GetActiveUser(false)->id)
                ->Where('message.creditCost', '>', '0')
                ->OrderBy('message.createdDate','DESC')
                ->FetchList();

            for ($i = 0; $i < sizeof($sentMessages); $i++) {
                $creditUsed = $creditUsed + $sentMessages[$i]->creditCost;
            }

            $data["creditUsed"] = $creditUsed;
            $data["smsCount"] = sizeof($sentMessages);

            $messages = T::Find('message')
                ->Join(['message_status'=>'status'], 'status.messageStatusId = message.messageStatusId', 'LEFT JOIN')
                ->Join('contact', 'contact.contactId = message.contactId')
                ->Join(['message_type'=>'type'], 'type.messageTypeId = message.messageTypeId', 'LEFT JOIN')
                ->Where('message.userId', '=', Auth::GetActiveUser(false)->id)
                ->Where('type.code', '=', "SMSRP")
                ->FetchList();

            $data["smsRepliesCount"] = sizeof($messages);

            $messages = T::Find('message')
                ->Join(['message_status'=>'status'], 'status.messageStatusId = message.messageStatusId', 'LEFT JOIN')
                ->Join('contact', 'contact.contactId = message.contactId')
                ->Join(['message_type'=>'type'], 'type.messageTypeId = message.messageTypeId', 'LEFT JOIN')
                ->Where('message.userId', '=', Auth::GetActiveUser(false)->id)
                ->Where('status.code', '=', "SMS")
                ->Where('message.creditCost', '=', '0')
                ->FetchList();

            $data["smsFailedCount"] = sizeof($messages);

            $this->view->set('summary', $data);
            $this->view->set('messages', array_slice($sentMessages, 0, 5));
            $this->view->render();
		}

        function buycredit() {

            $methods = T::Find('payment_method')
                ->FetchList();

            $this->view->set('methods', $methods);
            $this->view->render();
        }

        function purchases() {
            $purchases = T::Find('purchase')
                ->Join('status', 'status.id = purchase.refStatusId')
                ->Join(['payment_method'=>'method'], 'method.id = purchase.refPaymentMethodId')
                ->Where('purchase.refUserId', '=', Auth::GetActiveUser(false)->id)
                ->FetchList();
            $this->view->set('purchases', $purchases);
            $this->view->render();
        }

        function api() {
            $this->view->set('breadcrumb', 'API');
            $this->view->set('menuTitle', 'Developer');
            $this->view->render();
        }

        function summary () {

            $messages = T::Find('message')
                ->Join(['message_status'=>'status'], 'status.messageStatusId = message.messageStatusId', 'LEFT JOIN')
                ->Join('contact', 'contact.contactId = message.contactId')
                ->Join(['message_type'=>'type'], 'type.messageTypeId = message.messageTypeId', 'LEFT JOIN')
                ->Where('message.userId', '=', Auth::GetActiveUser(false)->id)
                ->OrderBy('message.createdDate','DESC')
                ->FetchList();

            $startDate = null;
            $endDate = null;

            if(!empty($data['StartDate'])) {
                $startDate = DateTime::toDate($data['StartDate'], DATE_FORMAT);
            }

            $this->view->set('messages', $messages);
            $this->view->set('menuTitle', 'All');
            $this->view->render();

        }


	}

?>