<?php
	namespace Controller\Admin;
	use BerkaPhp\Controller\BerkaPhpController;
    use BerkaPhp\Helper\Auth;
    use BerkaPhp\Helper\Check;
    use BerkaPhp\Helper\Debug;
    use BerkaPhp\Helper\Rand;
    use BerkaPhp\Helper\SessionHelper;
    use BerkaPhp\HelperRand;
    use BerkaPhp\Helper\RedirectHelper;
    use BerkaPhp\HelperessionHelper;
    use BrkORM\T;
    use Resource\Label;
    use Util\Helper;
    use Util\Request;

    class PagesController extends BerkaPhpController
	{


		function __construct() {
			parent::__construct();

		}

        function index() {
            $this->view->set('breadcrumb', array("Page", "Home"));
            $this->view->set('title', ucfirst($_SERVER['SERVER_NAME']) . " | Dashboard");
            $this->view->render();
        }
	}

?>