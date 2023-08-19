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

        function index($params = '') {

            $date = '';
            $startDate = date(DATE_FORMAT);
            $endDate = '';

            if(array_key_exists("endDate", $params['args']['query']))
                $endDate = $params['args']['query']['endDate'];

            if(array_key_exists("startDate", $params['args']['query']))
                $startDate = $params['args']['query']['startDate'];

            if(array_key_exists("date", $params['args']['query']))
                $date = $params['args']['query']['date'];

            $startDateFile = strtotime($startDate);

            $filePath = FILE_PATH.date('Y_m_d',$startDateFile).'.prediction';
            $data = Helper::GetFileContent($filePath);

            $array = [];

            if(strlen($data) > 0)
                $array = json_decode($data);

            $maxPrediction = sizeof($array);

            if(!\BerkaPhp\Helper\Auth::IsUserLogged())
                $maxPrediction = 8;

            $this->view->set('StartDate', $startDate);
            $this->view->set('EndDate', $endDate);
            $this->view->set('Date', $date);
            $this->view->set('predictions', $array);
            $this->view->set('maxPrediction', $maxPrediction);
            $this->view->render();
        }

        function policy() {
            $this->view->render();
        }


        function predictionfilters () {
            $this->view->render();
        }

        function about() {
            //$this->overWriteLayout('/Client/Layout/layoutMenu');
            $this->view->render();
        }

        function livescore() {
            //$this->overWriteLayout('/Client/Layout/layoutMenu');
            $this->view->render();
        }


	}

?>