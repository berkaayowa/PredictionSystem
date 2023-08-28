
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
                    <div class="col-xm-12 colFrmSearch col-lg-6">
                        <form class="frmSearch row" message="<?=Resource\Label::General("Searching")?>..."  method="GET" id="transactionSearch" ACTION="<?= BerkaPhp\Helper\Html::action('/prediction')?>">
                            <div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8 no-mg-b">
                                <div class="input-group">
                                    <input value="<?=$StartDate?>"  data-date="<?=DATE_SECOND_FORMAT?>" placeholder="<?=Resource\Label::General("StartDate")?>" type="text" class="form-control" name="startDate" id="startDate">
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4 no-mg-b">
                                <button type="submit" class="searchBtn btn btn-primary w-45 pull-left">
                                    <?=Resource\Label::General("Search")?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<?php \BerkaPhp\Helper\Element::Render("Predictions", "Client", array('predictionRequest'=>$predictionRequest, 'predictions'=>$predictions, 'shareCode'=>$shareCode, 'maxPrediction'=>$maxPrediction))?>