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
            $this->view->set('breadcrumb', array("Page", "Our Policies"));
            $this->view->set('title', ucfirst($_SERVER['SERVER_NAME']) . " | Policy");
            $this->view->render();
        }


        function about() {
            $this->view->set('breadcrumb', array("Page", "About Us"));
            $this->view->set('title', ucfirst($_SERVER['SERVER_NAME']) . " | About Us");
            $this->view->render();
        }

        function livescore() {

            $this->view->set('breadcrumb', array("Soccer", "Live Score"));
            $this->view->set('title', "Soccer Live Scores | Soccer Latest Results | " .$_SERVER['SERVER_NAME']);
            $this->view->set('titleDescription', "Football Live Scores | Football Latest Results | Daily Football Prediction");
            //$this->overWriteLayout('/Client/Layout/layoutMenu');
            $this->view->render();
        }

        function unauthorized() {

            $this->view->set('title', ucfirst($_SERVER['SERVER_NAME']) . " | Unauthorized Access");
            $this->view->set('breadcrumb', array("Resource", "Unauthorized Access"));
            $this->view->render();
        }

        function prediction_widget($params = array()) {

            $title = "";
            $date = '';
            $startDate = date(DATE_FORMAT);
            $endDate = '';
            $requetcode = '';
            $shareCode = false;
            $filePath = '';

            if(array_key_exists("endDate", $params['args']['query']))
                $endDate = $params['args']['query']['endDate'];

            if(array_key_exists("startDate", $params['args']['query']))
                $startDate = $params['args']['query']['startDate'];

            if(array_key_exists("date", $params['args']['query']))
                $date = $params['args']['query']['date'];

            if(array_key_exists("requestcode", $params['args']['query']))
                $requetcode = $params['args']['query']['requestcode'];

            $startDateFile = strtotime($startDate);

            if(empty($requetcode)) {

                $systemRequest = @T::Find('prediction_request')
                    ->Join(['prediction_request_status'=>'status'], 'status.id = prediction_request.predictionRequestStatusId')
                    ->Join('user', 'user.id = prediction_request.userId')
                    ->Join(['prediction_contribution'=>'configuration'], 'configuration.id = prediction_request.predictionContributionId')
                    ->Where('requestedDate' , '=', date(DB_DATE_FORMAT, $startDateFile))
                    ->Where('user.username', '=', SYSTEM_USER)
                    ->Where('prediction_request.isDeleted', '=', \Helper\Check::$False)
                    ->FetchFirstOrDefault();

                if($systemRequest->IsAny()) {
                    $requetcode = $systemRequest->id;
                    $title = "Free Soccer Predictions | Soccer Live Score | Latest Soccer Results";
                }

            }

            if(!empty($requetcode)) {

                $request = @T::Find('prediction_request')
                    ->Join('user', 'user.id = prediction_request.userId')
                    ->Join(['prediction_request_status'=>'status'], 'status.id = prediction_request.predictionRequestStatusId')
                    ->Join(['prediction_contribution'=>'configuration'], 'configuration.id = prediction_request.predictionContributionId')
                    ->Where('prediction_request.id', '=', $requetcode)
                    ->Where('prediction_request.isDeleted', '=', \Helper\Check::$False)
                    ->FetchFirstOrDefault();

                if($request->IsAny()) {
                    $filePath = FILE_PATH . $request->fileName;
                    $request->views = $request->views + 1;
                    $request->Save();

                    if(empty($title))
                        $title ="Customized Soccer Predictions |  " .ucfirst($request->description) . ' | ' . ucfirst($request->configuration->name) . ' | Author | ' . ucfirst($request->user->name);
                }

                $shareCode = true;
                $this->view->set('predictionRequest', $request);

            }
            else {
                $filePath = FILE_PATH.date('Y_m_d',$startDateFile).'.prediction';
                $this->view->set('predictionRequest', null);
                $title = "Free Soccer Predictions | Soccer Live Score | Latest Soccer Results";
            }

            $data = Helper::GetFileContent($filePath);

            $array = [];

            if(strlen($data) > 0)
                $array = json_decode($data);

            $maxPrediction = sizeof($array);

            if(!\BerkaPhp\Helper\Auth::IsUserLogged())
                $maxPrediction = 8;

            $this->view->set('breadcrumb', array("Predictions", "All", date('d-m-Y', strtotime($startDate))));
            $this->view->set('StartDate', $startDate);
            $this->view->set('EndDate', $endDate);
            $this->view->set('Date', $date);
            $this->view->set('predictions', $array);
            $this->view->set('maxPrediction', $maxPrediction);
            $this->view->set('shareCode', $shareCode);
            $this->view->set('title', $title);

            $this->overWriteLayout('/Client/Layout/layoutEmpty');
            $this->view->render();
        }


	}

?>