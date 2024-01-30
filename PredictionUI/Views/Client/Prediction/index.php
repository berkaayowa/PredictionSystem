
<?=\BerkaPhp\Helper\Element::Render("Breadcrumb", "Client", array("breadcrumb"=>$breadcrumb))?>

<?php if(!empty(SYSTEM_NOTIFICATION)): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="box  box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12 center">
                            <span class="label label-danger" role="alert"><span class="fa fa-warning"></span></span>
                            <span> <?=SYSTEM_NOTIFICATION?> </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<?php if(true || !$shareCode): ?>
    <div class="row">
        <div class="col-sm-12 ">
            <div class="box box-default ">
                <div class="box-body row ">
                    <div class="col-xm-12 colFrmSearch col-lg-12">
                        <form class="frmSearch row" message="<?=Resource\Label::General("Searching")?>..."  method="GET" id="transactionSearch" ACTION="<?= BerkaPhp\Helper\Html::action('/prediction')?>">
                            <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4 no-mg-b">
                                <div class="input-group">
                                    <input value="<?=$StartDate?>"  data-date="<?=DATE_SECOND_FORMAT?>" placeholder="<?=Resource\Label::General("StartDate")?>" type="text" class="form-control" name="startDate" id="startDate">
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8 no-mg-b">
                                <button type="submit" class="searchBtnHome btn btn-primary">
                                    <?=Resource\Label::General("Search")?>
                                </button>
                                <?php if($predictionRequest != null && $predictionRequest->IsAny()) :?>
                                    <a class="searchBtnHome btn btn-success" href="/coupons/index/<?=$predictionRequest->id?>?oddDifference=0&numberOfGamesPerCoupon=5&numberOfGamesPerLeague=1&leaguePointPercentageOverOREqual=1.8&gameMotivation=2.5&h2hPercentage=3&gameLocation=0&allowedDuplicateGame=2&&options%5B%5D=Win_at&options%5B%5D=Win%2FDraw_at&leaguePositionPercentageOverOREqual=0" >
                                        <?=Resource\Label::General("Recommended Matches")?>
                                    </a>
                                <?php endif;?>
                                <?php if(false && $predictionRequest != null && $predictionRequest->IsAny()) :?>
                                    <a class="searchBtnHome btn btn-success" href="/coupons/index/<?=$predictionRequest->id?>?oddDifference=0&numberOfGamesPerCoupon=10&numberOfGamesPerLeague=2&leaguePointPercentageOverOREqual=2&gameMotivation=2.5&h2hPercentage=2&gameLocation=0&allowedDuplicateGame=2&&options%5B%5D=Win_at&options%5B%5D=Win%2FDraw_at&leaguePositionPercentageOverOREqual=0&teamsLeaguePointsDiff=3&teamsLeaguePositionDiff=9" >
                                        <?=Resource\Label::General("View Recommended Coupons")?>
                                    </a>
                                <?php endif;?>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<?php \BerkaPhp\Helper\Element::Render("Predictions", "Client", array('predictionRequest'=>$predictionRequest, 'predictions'=>$predictions, 'shareCode'=>$shareCode, 'maxPrediction'=>$maxPrediction))?>