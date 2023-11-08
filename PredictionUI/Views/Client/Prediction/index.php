
<?=\BerkaPhp\Helper\Element::Render("Breadcrumb", "Client", array("breadcrumb"=>$breadcrumb))?>

<?php if(!\BerkaPhp\Helper\Auth::IsUserLogged() && sizeof($predictions) > 0): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="box  box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12 center">
                            <div class="label label-success" role="alert"><?=sizeof($predictions)?></div> Predictions are available, consider signing in to enjoy more free features such daily coupons and more from our platform.
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
                    <div class="col-xm-12 colFrmSearch col-lg-8">
                        <form class="frmSearch row" message="<?=Resource\Label::General("Searching")?>..."  method="GET" id="transactionSearch" ACTION="<?= BerkaPhp\Helper\Html::action('/prediction')?>">
                            <div class="form-group col-xs-12 col-sm-6 col-md-5 col-lg-5 no-mg-b">
                                <div class="input-group">
                                    <input value="<?=$StartDate?>"  data-date="<?=DATE_SECOND_FORMAT?>" placeholder="<?=Resource\Label::General("StartDate")?>" type="text" class="form-control" name="startDate" id="startDate">
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-md-7 col-lg-7 no-mg-b">
                                <button type="submit" class="searchBtnHome btn btn-primary">
                                    <?=Resource\Label::General("Search")?>
                                </button>
                                <?php if($predictionRequest != null && $predictionRequest->IsAny()) :?>
                                    <a class="searchBtnHome btn btn-success" href="/coupons/index/<?=$predictionRequest->id?>?oddDifference=1.1&numberOfGamesPerCoupon=5&numberOfGamesPerLeague=1&leaguePointPercentageOverOREqual=1.8&gameMotivation=2.5&h2hPercentage=3&gameLocation=0&allowedDuplicateGame=2&&options%5B%5D=Win_at&options%5B%5D=Win%2FDraw_at&leaguePositionPercentageOverOREqual=0" >
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