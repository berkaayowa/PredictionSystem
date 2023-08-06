<?php
	namespace Controller\Client;
	use BerkaPhp\Controller\BerkaPhpController;
    use BerkaPhp\Helper\Debug;
    use BrkORM\T;


    class ContactController extends BerkaPhpController
	{

		function __construct() {
			parent::__construct(false);
            $this->view->set('menuTitle', 'Contact Us');
		}

        /* Display all users from database
        *  Client action in this controller
        *  @author berkaPhp
        */

		function index() {

            $contact = T::Find('contact')->Where('isDeleted', '=', '0')->FetchFirstOrDefault();
            $this->view->set('contacts', $contact);
			$this->view->render();

		}

	}

?>