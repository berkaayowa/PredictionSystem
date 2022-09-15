<?php
	namespace Controller\Job;
    use BerkaPhp\Helper\Check;
    use BerkaPhp\Helper\Debug;
    use BrkORM\T;
    use Controller\RestfulApiController;


    class UsersController extends RestfulApiController
	{

		function __construct() {
			parent::__construct();
		}

		function balance($option) {

            if(isset($option['args']) && isset($option['args']['query']) && isset($option['args']['query']['code'])) {

                $code = $option['args']['query']['code'];

                if($code == 'run') {

                    $users = T::Find('user')
                        ->Join('status', 'status.id = user.refStatusId')
                        ->FetchList();

                    foreach($users as $user){

                        if($user->balance < 5 && $user->balanceNotification == Check::$False) {

                            $message = "Dear " . ucfirst($user->name) . ' ' . ucfirst($user->surname) .' <br><br>Your SMS credit/s is left '. $user->balance
                                . '. <br><br>' . 'Please <a href="'.SITE_URL.'">click here </a> to log onto the portal and load more credits.';

                            $this->view->set('emailContent', $message);

                            $content = $this->view->renderGetContent('Views/Email/default');

                            $isSent = $this->email()->initialize()->send('Softclicktech.com','Sms credit notification', '',$content, $user->email);

                            if($isSent) {
                                $user = T::Find('user', $user->id)->FetchFirstOrDefault();
                                if($user->IsAny()) {
                                    $user->balanceNotification = Check::$True;
                                    $user->Save();
                                }
                            } else {

                            }
                        }


                    }

                }
            }

		}

        function weeklybalance($option) {

            if(isset($option['args']) && isset($option['args']['query']) && isset($option['args']['query']['code'])) {

                $code = $option['args']['query']['code'];

                if($code == 'run') {

                    $users = T::Find('user')
                        ->Join('status', 'status.id = user.refStatusId')
                        ->FetchList();

                    foreach($users as $user){

                        $message = "Dear " . ucfirst($user->name) . ' ' . ucfirst($user->surname) .' <br><br>Thank you for trusting softclick tech (Pty) Ltd for your sms solution. </br></br>
                         Your current SMS credit/s is <strong>'. $user->balance . '</strong>. <br><br> <a href="'.SITE_URL.'">Click here </a> to log onto the portal.';

                        $this->view->set('emailContent', $message);

                        $content = $this->view->renderGetContent('Views/Email/default');

                        $isSent = $this->email()->initialize()->send('Softclicktech.com','Weekly sms credits notification', '',$content, $user->email);


                    }

                }
            }

        }

	}

?>