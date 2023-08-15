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

    class CouponsController extends BerkaPhpController
	{


		function __construct() {
			parent::__construct();

		}

        function index($params = array()) {


            $request = @T::Find('prediction_request')
                ->Join(['prediction_request_status'=>'status'], 'status.id = prediction_request.predictionRequestStatusId')
                ->Join(['prediction_contribution'=>'configuration'], 'configuration.id = prediction_request.predictionContributionId')
                ->Where('prediction_request.userId', '=', Auth::GetActiveUser(true)->id)
                ->Where('prediction_request.isDeleted', '=', \Helper\Check::$False)
                ->Where('prediction_request.id', '=', $params['args']['params'][0])
                ->FetchFirstOrDefault();

            $coupons = array();

            if($request->IsAny()) {

                $leagues = $params['args']['query']['leagueId'];

                $numberOfGamesPerCoupon = $params['args']['query']['numberOfGamesPerCoupon'];
                $numberOfGamesPerLeague = $params['args']['query']['numberOfGamesPerLeague'];

                $leaguePointPercentageOverOREqual = $params['args']['query']['leaguePointPercentageOverOREqual'];
                $gameMotivation = $params['args']['query']['gameMotivation'];
                $h2hPercentage = $params['args']['query']['h2hPercentage'];
                $gameLocation = $params['args']['query']['gameLocation'];

                $filePath = FILE_PATH . $request->fileName;
                $data = Helper::GetFileContent($filePath);
                $array = [];

                if(strlen($data) > 0) {

                    $predictions = json_decode($data);

                    foreach ($predictions as $prediction) {

                        $selectedLeague = false;

                        foreach($leagues as $league) {

                            if ($league == Helper::ConvertStrToKey($prediction->League)) {

                                if($prediction->HomeTeam->LeaguePointPerecentage >= $leaguePointPercentageOverOREqual || $prediction->AwayTeam->LeaguePointPerecentage >= $leaguePointPercentageOverOREqual) {

                                    if($prediction->HomeTeam->HeadtoheadPerecentage >= $h2hPercentage || $prediction->AwayTeam->HeadtoheadPerecentage >= $h2hPercentage) {

                                        if($prediction->HomeTeam->AwayOrHomePerecentage >= $gameMotivation || $prediction->AwayTeam->AwayOrHomePerecentage >= $gameMotivation) {

                                            $selectThisGame = true;

                                            if($gameLocation == "1") {


                                            } else {

                                            }

                                            if($selectThisGame)
                                                array_push($coupons, $prediction);



                                        }

                                    }

                                }

                            }
                        }

                    }

                }

                $this->view->set('league', $leagues);
                $this->view->set('predictionRequest', $request);
            }

            $this->view->set('predictions', $coupons);
            $this->view->set('maxPrediction', sizeof($coupons));

            $this->view->render();
        }

        function filters($params = array()) {

            $leagues = array();

            $request = @T::Find('prediction_request')
                ->Join(['prediction_request_status'=>'status'], 'status.id = prediction_request.predictionRequestStatusId')
                ->Join(['prediction_contribution'=>'configuration'], 'configuration.id = prediction_request.predictionContributionId')
                ->Where('prediction_request.userId', '=', Auth::GetActiveUser(true)->id)
                ->Where('prediction_request.isDeleted', '=', \Helper\Check::$False)
                ->Where('prediction_request.id', '=', $params['args']['query']['predictionId'])
                ->FetchFirstOrDefault();

            if($request->IsAny()) {

                $filePath = FILE_PATH . $request->fileName;
                $data = Helper::GetFileContent($filePath);
                $array = [];

                if(strlen($data) > 0) {

                    $predictions = json_decode($data);

                    foreach ($predictions as $prediction) {

                        $found = false;

                        foreach($leagues as $league) {
                            if ($league['value'] == Helper::ConvertStrToKey($prediction->League)) {
                                $found = true;
                                break;
                            }
                        }

                        if(!$found)
                            array_push($leagues, ["value"=>Helper::ConvertStrToKey($prediction->League), "text"=>$prediction->League]);
                    }

                }

                $this->view->set('request', $request);
            }

            $this->view->set('leagues', $leagues);
            $this->view->render();
        }


	}

?>