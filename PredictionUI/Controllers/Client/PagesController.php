<?php
	namespace Controller\Client;
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

            $filePath = 'Prediction/'.date('Y_m_d').'.prediction';
//            die($filePath);
            $data = Helper::GetFileContent($filePath);

            $array = [];

            if(strlen($data) > 0)
                $array = json_decode($data);

            $this->overWriteLayout('/Client/Layout/layoutNoMenu');
            $this->view->set('predictions', $array);
            $this->view->render();
        }


	}

?>