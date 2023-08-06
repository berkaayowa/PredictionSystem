<?php
	namespace Controller\Client;
	use BerkaPhp\Controller\BerkaPhpController;
    use BerkaPhp\Helper\Debug;
    use BrkORM\T;
    use Helper\Check;


    class AboutusController extends BerkaPhpController
	{

		function __construct() {
			parent::__construct(false);
            $this->view->set('menuTitle', 'About Us');
		}

        /* Display all users from database
        *  Client action in this controller
        *  @author berkaPhp
        */

		function index() {

            $about = T::Find('about')->Where('isDeleted', '=', Check::$False)->FetchFirstOrDefault();
            $this->view->set('about', $about);
			$this->view->render();

		}

	}

?>