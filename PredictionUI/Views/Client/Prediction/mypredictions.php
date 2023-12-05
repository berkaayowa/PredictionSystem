<?=\BerkaPhp\Helper\Element::Render("Breadcrumb", "Client", array("breadcrumb"=>$breadcrumb))?>
<?php
$subscription = \Util\Helper::GetCurrentUserSubscription();
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1"><i class="fa fa-info-circle "></i> Click here if you need help.</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="box  box-default ">
                        <div class="box-body ">
                            <div class="markdown prose w-full break-words dark:prose-invert light">

                                <p>To request custom prediction, follow these steps:
                                <strong>'Request setup':</strong> enter the prediction request's name and the game's fixture date.
                                <strong>Template selection:</strong> choose a suitable prediction template from the available options. If none fits, create a custom one.
                                <strong>Notification preference:</strong> opt for notifications by selecting "Notify: Yes" if you wish to be alerted upon prediction completion.
                                <strong>Submission:</strong> finalize the process by clicking on 'Request Predictions'.</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default ">
            <form class=" " message="<?=Resource\Label::General("Requesting")?>..."  request-type="POST" id="request" data-request="<?= BerkaPhp\Helper\Html::action('/prediction/requestprediction')?>">
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-sm-3 col-md-3 col-lg-2">
                            <input type="text" required placeholder="Request Name" autocomplete="off" class="form-control" name="description" id="description">
                        </div>
                        <div class="form-group col-sm-3 col-md-3 col-lg-3">
                            <div class="input-group">
                                <input required autocomplete="off" max="<?= date('m-d-Y', strtotime(DATE_NOW. ' + '.$subscription->numOfUpfrondRequestDays.' days')) ?>" data-date-max="<?= DATE_SECOND_FORMAT ?>" placeholder="<?=Resource\Label::General("Fixtures Date")?>" type="text" class="form-control" name="date" id="date">
                                <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                            </div>
                        </div>
                        <div class="form-group col-sm-3 col-md-3 col-lg-3">
                            <?= Util\Helper::select('configuration', $pconfig, ['default'=>'Select Template','value'=>'id', 'class'=>'form-control', 'data-dropdrown'=>true, 'required'=>true], function($data) {
                                if(empty($data['description']))
                                    return $data['name'];
                                else
                                    return $data['name'];
                            }) ?>
                        </div>
                        <div class="form-group col-sm-3 col-md-3 col-lg-2">
                            <div class="input-group">
                            <?= Util\Helper::select('notify', [['id'=>'0','label'=>'No'],['id'=>'1','label'=>'Yes']], ['value'=>'id', 'class'=>'form-control', 'data-dropdrown'=>true, 'required'=>true], function($data) {
                                return $data['label'];
                            }) ?>
                            <span class="input-group-addon">
                                <span class="">Notify Me</span>
                            </span>

                            </div>
                        </div>
                        <div class="form-group col-sm-3 col-md-3 col-lg-2">
                            <button type="submit" class="btn btn-primary btn-themed">
                                <?=Resource\Label::General("Request Predictions")?>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel-footer bg-white center-on-mobile">
                                <a href="/template" class="">
                                    <?=Resource\Label::General("View Or Create Prediction Templates")?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if(true): ?>
                            <div class="">
                                <?php foreach ($predictionRequest as $request ): ?>
                                    <div class="d-flex cardHolder" title="<?=ucfirst($request->description)?> | <?=$request->configuration->description?>">
                                        <div class="card m-2 " style="">
                                            <div class="row g-0">
                                                <div class="col-sm-12">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><span class="sp-item <?= $request->status->code == 'PG' || $request->status->code == 'INP' ? \Util\Helper::GetPredictionBg( 100) : ""?>">#<?=$request->id?> <?=$request->status->name?></span>  <span class="hideOnMobile">| <span class="glyphicon glyphicon-time action-icon"></span> Created On <?= date(DATE_SECOND_FORMAT, strtotime($request->createdDate))?></span>
                                                            | Created By <a><span class="glyphicon glyphicon-user "></span> <?=ucfirst($request->user->name)?> <?=ucfirst($request->user->surname)?></a></h5>
                                                        <p class="card-text">
                                                            <?=ucfirst($request->description)?>, Requested Date: <?= date('d-m-Y', strtotime($request->requestedDate))?>
                                                            ,Template: <?=$request->configuration->name?>, (Notify) <?=$request->notify == \Helper\Check::$True ? 'Yes' : 'No'?>
                                                        </p>
                                                        <div class="card-text action-holder">
                                                            <?php if($request->status->code == 'CNP') : ?>
                                                                <a target="_blank" class="tb-action" title="View Predictions" href="/prediction?requestcode=<?=$request->id?>" >
                                                                    <span class="fa fa-list-alt action-icon"></span> Games
                                                                </a>
                                                                <a target="_blank" class="tb-action" title="Create Coupons" href="/coupons/index/<?=$request->id?>?oddDifference=0&numberOfGamesPerCoupon=10&numberOfGamesPerLeague=1&leaguePointPercentageOverOREqual=0&gameMotivation=0&h2hPercentage=0&gameLocation=0&options%5B%5D=Win_at&options%5B%5D=Win%2FDraw_at&options%5B%5D=Draw_at&allowedDuplicateGame=2&leaguePositionPercentageOverOREqual=0" >
                                                                    <span class="glyphicon glyphicon-edit action-icon"></span> Coupons
                                                                </a>
                                                                <a data-ajax-confirmation confirmation-title="Confirmation" confirmation-message="Please confirm to regenerate (<?=ucfirst($request->description)?>)" class="tb-action" title="Delete" href="/prediction/regenerate/<?=$request->id?>">
                                                                    <span class="glyphicon glyphicon-refresh action-icon"></span> Regenerate
                                                                </a>

                                                                <?php if((\BerkaPhp\Helper\Auth::IsUserLogged() && BerkaPhp\Helper\Auth::GetActiveUser()->role->code == 'ADM')): ?>
                                                                    <a data-ajax-confirmation confirmation-title="Confirmation" confirmation-message="Please confirm to regenerate (No caching) (<?=ucfirst($request->description)?>)" class="tb-action" title="Delete" href="/prediction/regenerate/<?=$request->id?>?cache=true">
                                                                        <span class="glyphicon glyphicon-warning-sign action-icon"></span> Regenerate (No caching)
                                                                    </a>
                                                                <?php endif ?>

                                                            <?php endif ?>
                                                            <a class="tb-action" target="_blank" title="<?=$request->views?> Views <?php if($request->totalPredictions > 0) :?>
                                                                    | <?=$request->correctPredictions?> out of <?=$request->totalPredictions?>
                                                                <?php endif ?>" href="/prediction?requestcode=<?=$request->id?>" >
                                                                <span class="glyphicon glyphicon-eye-open action-icon"></span><?=$request->views?> Views
                                                            </a>
                                                            <a data-ajax-confirmation confirmation-title="Confirmation" confirmation-message="Please confirm to delete this prediction request (<?=ucfirst($request->description)?>)" class="tb-action" title="Delete" href="/prediction/delete/<?=$request->id?>">
                                                                <span class="glyphicon glyphicon-remove action-icon"></span> Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <?php else: ?>
                            <div class="txt-capitalized text-center">No predictions available</div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    $(document).ready(function (e) {

        $('[data-date-max]').each(function(e) {

            alert($(this).attr("max"));

            var endDate =  new Date($(this).attr("max"));

            $(this).datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy',
                endDate: endDate
            });

        })

        // $('[data-date-max]').datepicker({
        //     autoclose: true,
        //     format: 'dd-mm-yyyy',
        //     endDate: new Date()
        // });

        if($('.bg-safe').length > 0) {

            setTimeout(function () {
                // alert('Reloading Page');
                location.reload(true);
            }, 10000);

        }


    })



</script>
