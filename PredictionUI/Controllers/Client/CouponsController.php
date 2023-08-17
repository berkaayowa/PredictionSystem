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

            $selectedGames = array();
            $couponGenerated = array();
            $gameGroupedByLeague = array();


            if($request->IsAny()) {

                $leagues = null;

                if(array_key_exists('leagueId', $params['args']['query']))
                    $leagues = $params['args']['query']['leagueId'];

                $numberOfGamesPerCoupon = (int)$params['args']['query']['numberOfGamesPerCoupon'];
                $numberOfGamesPerLeague = (int)$params['args']['query']['numberOfGamesPerLeague'];

                $leaguePointPercentageOverOREqual = $params['args']['query']['leaguePointPercentageOverOREqual'];
                $gameMotivation = $params['args']['query']['gameMotivation'];
                $h2hPercentage = $params['args']['query']['h2hPercentage'];
                $gameLocation = $params['args']['query']['gameLocation'];
                $allowedDuplicateGame = $params['args']['query']['allowedDuplicateGame'] == '1';

                $filePath = FILE_PATH . $request->fileName;
                $data = Helper::GetFileContent($filePath);
                $array = [];

                if(strlen($data) > 0) {

                    if($leagues == null)
                        $leagues = self::getUniqueLeagueIds($request);

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

                                                if($prediction->HomeTeam->TotalPerecentage < $prediction->AwayTeam->TotalPerecentage)
                                                    $selectThisGame = false;

                                            } else if($gameLocation == "2") {

                                                if ($prediction->HomeTeam->TotalPerecentage > $prediction->AwayTeam->TotalPerecentage)
                                                    $selectThisGame = false;
                                            }

                                            if($selectThisGame)
                                                array_push($selectedGames, $prediction);


                                        }

                                    }

                                }

                            }
                        }

                    }

                    if(sizeof($selectedGames) > 0) {

                        foreach ($selectedGames as $filterGame) {

                            if(array_key_exists(Helper::ConvertStrToKey($filterGame->League), $gameGroupedByLeague)){
                                array_push($gameGroupedByLeague[Helper::ConvertStrToKey($filterGame->League)], $filterGame);
                            } else {
                                $gameGroupedByLeague[Helper::ConvertStrToKey($filterGame->League)] = array();
                                array_push($gameGroupedByLeague[Helper::ConvertStrToKey($filterGame->League)], $filterGame);
                            }

                        }

                    }

                    $numberOfCoupons = sizeof($selectedGames) / $numberOfGamesPerCoupon;

                    if(sizeof($gameGroupedByLeague) > 0) {

                        for ($i = 0; $i < $numberOfCoupons; $i++) {

                            $coupon = array();

                            foreach ($gameGroupedByLeague as $leagueGames) {

                                $numberOfGamesPerLeagueCount = 0;

                                foreach ($leagueGames as $game) {

                                    $addToCoupon = true;

                                    if($numberOfGamesPerLeagueCount == $numberOfGamesPerLeague)
                                        break;
                                    if (sizeof($coupon) == ($numberOfGamesPerCoupon))
                                        break;

                                    if($allowedDuplicateGame === false) {

                                        foreach ($couponGenerated as $cCoupon) {

                                            foreach ($cCoupon as $cGame) {

                                                if($game->UniqueId == $cGame->UniqueId) {
                                                    $addToCoupon = false;
                                                    break;
                                                }

                                            }

                                            if(!$addToCoupon)
                                                break;
                                        }

                                    }

                                    if ($addToCoupon) {
                                        array_push($coupon, $game);
                                        $numberOfGamesPerLeagueCount++;
                                    }

                                }

                            }

                            if(sizeof($coupon) > 0)
                                array_push($couponGenerated, $coupon);

                        }

                    }

                    $this->view->set('leagueIds', self::getUniqueLeagues($request));

                }

                $this->view->set('couponGenerated', $couponGenerated);
                $this->view->set('selectedLeague', $leagues);
                $this->view->set('predictionRequest', $request);
                $this->view->set('request', $request);
            }

            $this->view->set('numberOfGamesPerCoupon', $numberOfGamesPerCoupon);
            $this->view->set('numberOfGamesPerLeague', $numberOfGamesPerLeague);
            $this->view->set('leaguePointPercentageOverOREqual', $leaguePointPercentageOverOREqual);
            $this->view->set('gameMotivation', $gameMotivation);
            $this->view->set('h2hPercentage', $h2hPercentage);
            $this->view->set('gameLocation', $gameLocation);
            $this->view->set('allowedDuplicateGame', $allowedDuplicateGame);

            $this->view->set('predictions', $selectedGames);
            $this->view->set('maxPrediction', sizeof($selectedGames));

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

                $leagues = self::getUniqueLeagues($request);

                $this->view->set('request', $request);
            }

            $this->view->set('leagues', $leagues);
            $this->view->render();
        }

        private function getUniqueLeagues($request) {

            $filePath = FILE_PATH . $request->fileName;
            $data = Helper::GetFileContent($filePath);
            $array = [];
            $leagues = array();

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

            return $leagues;

        }

        private function getUniqueLeagueIds($request) {

            $filePath = FILE_PATH . $request->fileName;
            $data = Helper::GetFileContent($filePath);
            $array = [];
            $leagues = array();

            if(strlen($data) > 0) {

                $predictions = json_decode($data);

                foreach ($predictions as $prediction) {

                    $found = false;

                    foreach($leagues as $league) {
                        if ($league == Helper::ConvertStrToKey($prediction->League)) {
                            $found = true;
                            break;
                        }
                    }

                    if(!$found)
                        array_push($leagues, Helper::ConvertStrToKey($prediction->League));
                }

            }

            return $leagues;

        }


	}

?>