<?php
	namespace Controller\Client;
    use BerkaPhp\Controller\BerkaPhpController;
    use BerkaPhp\Helper\Auth;
    use BerkaPhp\Helper\Check;
    use BerkaPhp\Helper\DateTime;
    use BerkaPhp\Helper\Debug;
    use BerkaPhp\Helper\Html;
    use BrkORM\T;
    use Util\Request;

    class ContactsController extends BerkaPhpController
	{
        private $mailer;

		function __construct() {
			parent::__construct();
            $this->mailer = $this->loadComponent("Email");
            $this->view->set('breadcrumb', 'Contacts');
		}

		function index() {

            $data = $this->getPost();

            if(sizeof($data) > 0) {

                if(!empty($data["message"]) && !empty($data["email"]) && !empty($data["fullname"])) {

                    $ourEmail = 'soccerprediction.co.za@gmail.com';

                    $emailContent = "Hi,<br><br>You have new message from the contact form below are the details<br><br>";
                    $emailContent = $emailContent."Name: ".ucfirst($data["fullname"])."<br>Email: ".$data["email"].'<br><br>';
                    $emailContent = $emailContent."".$data["message"]."";
                    $this->view->set('emailContent', $emailContent);

                    $content = $this->view->renderGetContent('Views/Email/default');
                    $isSent = $this->mailer->send(EMAIL_FROM_NAME, ucfirst($_SERVER['SERVER_NAME']) . ' - New Message', "", $content, $ourEmail);

                    if($isSent)
                        return $this->jsonFormat(['success'=>true,'error'=> false, 'message'=> "Your message has been sent to us successfully.", 'link'=>'/contacts']);
                    else
                        return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> "Your message could not be sent to us, try again or email us using our contacts information"]);

                }
                else
                    return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> "Please fill in all fields and, try again"]);


            }

            $this->view->set('breadcrumb', array("Page", "Contact Us"));
            $this->view->set('title', ucfirst($_SERVER['SERVER_NAME']) . ' | Contact Us');
            $this->view->set('titleDescription', "Football Live Scores | Football Latest Results | Daily Football Prediction");
            $this->view->render();
		}


	}

?>