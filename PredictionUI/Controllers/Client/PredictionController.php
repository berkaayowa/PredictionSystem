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

    class PredictionController extends BerkaPhpController
	{


		function __construct() {
			parent::__construct();

		}

        function index($params = '') {

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

                    $this->view->set('title', "Customized Soccer Predictions |  " .ucfirst($request->description) . ' | ' . ucfirst($request->configuration->name) . ' | Author | ' . ucfirst($request->user->name));

                }

                $shareCode = true;
                $this->view->set('predictionRequest', $request);

            }
            else {
                $filePath = FILE_PATH.date('Y_m_d',$startDateFile).'.prediction';
                $this->view->set('predictionRequest', null);
                $this->view->set('title', "Free Soccer Predictions | Soccer Live Score | Latest Soccer Results");
            }

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
            $this->view->set('shareCode', $shareCode);
            $this->view->set('breadcrumb', "Predictions");
            $this->view->render();
        }

        function mypredictions($params = null) {

            $date = '';
            $startDate = date(DATE_FORMAT);
            $endDate = '';

            if(array_key_exists("endDate", $params['args']['query']))
                $endDate = $params['args']['query']['endDate'];

            if(array_key_exists("startDate", $params['args']['query']))
                $startDate = $params['args']['query']['startDate'];

            if(array_key_exists("date", $params['args']['query']))
                $date = $params['args']['query']['date'];

            $config = T::Find('prediction_contribution')
                ->Where("isDeleted", "=", \Helper\Check::$False);

            if(Auth::GetActiveUser(true)->role->code == 'CLT')
                $config = $config->Where('userId', '=', Auth::GetActiveUser(true)->id);

            $config = $config->FetchList(['assocArray'=>true]);

            $requests = @T::Find('prediction_request')
                ->Join(['prediction_request_status'=>'status'], 'status.id = prediction_request.predictionRequestStatusId')
                ->Join(['prediction_contribution'=>'configuration'], 'configuration.id = prediction_request.predictionContributionId')
                ->Where('prediction_request.userId', '=', Auth::GetActiveUser(true)->id)
                ->Where('prediction_request.isDeleted', '=', \Helper\Check::$False)
                ->OrderBy('prediction_request.id')
                ->FetchList();

            $leagues = @T::Find('league')
                ->Where('league.isDeleted', '=', \Helper\Check::$False)
                ->FetchList();


            $freeTemplates = @T::Find('prediction_contribution')
                ->Where('prediction_contribution.isDeleted', '=', \Helper\Check::$False)
                ->Where('prediction_contribution.userId', '=', '0')
                ->FetchList(['assocArray'=>true]);

            $config = array_merge($config, $freeTemplates);

            $this->view->set('leagues', $leagues);
            $this->view->set('predictionRequest', $requests);
            $this->view->set('pconfig', $config);
            $this->view->render();
        }

        function requestprediction($params = null) {

            $data = $this->getPost();

            if(sizeof($data) > 0) {

                if(empty($data['date']))
                    return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> "Invalid fixtures date"]);

                $date = date(DB_DATE_FORMAT, strtotime($data['date']));

                $request = @T::Find('prediction_request')
                    ->Join(['prediction_request_status'=>'status'], 'status.id = user.userStatusId')
                    ->Where('requestedDate' , '=', $date)
                    ->Where('predictionContributionId' , '=',  $data['configuration'])
                    ->Where('prediction_request.userId', '=', Auth::GetActiveUser(true)->id)
                    ->Where('prediction_request.isDeleted', '=', \Helper\Check::$False)
                    ->FetchFirstOrDefault();

                if($request->IsAny())
                    return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> "This prediction request is already " . $request->status->name]);
                else {

                    $status = @T::Find('prediction_request_status')
                        ->Where('code' , '=', 'PG')
                        ->Where('isDeleted', '=', \Helper\Check::$False)
                        ->FetchFirstOrDefault();

                    $config = @T::Find('prediction_contribution')
                        ->Where('prediction_contribution.id', '=', $data['configuration'])
                        ->Where('isDeleted', '=', \Helper\Check::$False)
                        ->FetchFirstOrDefault();

                    if(!$config->IsAny())
                        return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> "The selected template doesn't exist , try again"]);

                    $request->requestedDate = $date;
                    $request->predictionContributionId = $config->id;
                    $request->userId = Auth::GetActiveUser(true)->id;
                    $request->createdDate = DATE_NOW;
                    $request->predictionRequestStatusId = $status->id;
                    $request->notify = $data['notify'];
                    $request->description = $data['description'];

                    if($request->Save())
                        return $this->jsonFormat(['success'=>true,'error'=> false, 'message'=> "Your request has been successfully received.", 'link'=>'/prediction/mypredictions']);
                    else
                        return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> "Your request couldn't be saved, try again"]);

                }

            }

        }

        function template($params = null) {

            $data = $this->getPost();

            if(sizeof($data) > 0) {

                if(empty($data['date']))
                    return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> "Invalid fixtures date"]);

                $date = date(DB_DATE_FORMAT, strtotime($data['date']));

                $request = @T::Find('prediction_request')
                    ->Join(['prediction_request_status'=>'status'], 'status.id = user.userStatusId')
                    ->Where('requestedDate' , '=', $date)
                    ->Where('predictionContributionId' , '=',  $data['configuration'])
                    ->Where('prediction_request.userId', '=', Auth::GetActiveUser(true)->id)
                    ->Where('prediction_request.isDeleted', '=', \Helper\Check::$False)
                    ->FetchFirstOrDefault();

                if($request->IsAny())
                    return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> "This prediction request is already " . $request->status->name]);
                else {

                    $status = @T::Find('prediction_request_status')
                        ->Where('code' , '=', 'PG')
                        ->Where('isDeleted', '=', \Helper\Check::$False)
                        ->FetchFirstOrDefault();

                    $request->requestedDate = $date;
                    $request->predictionContributionId = $data['configuration'];
                    $request->userId = Auth::GetActiveUser(true)->id;
                    $request->createdDate = DATE_NOW;
                    $request->predictionRequestStatusId = $status->id;
                    $request->notify = $data['notify'];

                    if($request->Save())
                        return $this->jsonFormat(['success'=>true,'error'=> false, 'message'=> "Your request has been successfully received.", 'link'=>'/prediction/mypredictions']);
                    else
                        return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> "Your request couldn't be saved, try again"]);

                }

            }
            else {

                $templates = @T::Find('prediction_contribution')
                    ->Where('prediction_contribution.userId', '=', Auth::GetActiveUser(true)->id)
                    ->Where('prediction_contribution.isDeleted', '=', \Helper\Check::$False)
                    ->FetchList();

                $this->view->set('predictionTemplates', $templates);
                $this->view->render();

            }


        }

        function mobile($params = array()) {

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

                    $this->view->set('title', "Customized Soccer Predictions |  " .ucfirst($request->description) . ' | ' . ucfirst($request->configuration->name) . ' | Author | ' . ucfirst($request->user->name));

                }

                $shareCode = true;
                $this->view->set('predictionRequest', $request);

            }
            else {
                $filePath = FILE_PATH.date('Y_m_d',$startDateFile).'.prediction';
                $this->view->set('predictionRequest', null);
                $this->view->set('title', "Free Soccer Predictions | Soccer Live Score | Latest Soccer Results");
            }

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
            $this->view->set('shareCode', $shareCode);
            $this->view->set('breadcrumb', "Predictions");
            $this->view->render();
        }


	}

?>