<?=\BerkaPhp\Helper\Element::Render("Breadcrumb", "Client", array("breadcrumb"=>$breadcrumb))?>
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
                        <div class="form-group col-sm-3 col-md-3 ">
                            <input type="text" required placeholder="Prediction Request Name" autocomplete="off" class="form-control" name="description" id="description">
                        </div>
                        <div class="form-group col-sm-3 col-md-3 ">
                            <div class="input-group">
                                <input required autocomplete="off" data-date-max="<?=DATE_SECOND_FORMAT?>" placeholder="<?=Resource\Label::General("Fixtures Date")?>" type="text" class="form-control" name="date" id="date">
                                <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                            </div>
                        </div>
                        <div class="form-group col-sm-3 col-md-3 ">
                            <?= Util\Helper::select('configuration', $pconfig, ['default'=>'Select Template','value'=>'id', 'class'=>'form-control', 'data-dropdrown'=>true, 'required'=>true], function($data) {
                                if(empty($data['description']))
                                    return $data['name'];
                                else
                                    return $data['name'];
                            }) ?>
                        </div>
                        <div class="form-group col-sm-3 col-md-3 ">
                            <div class="input-group">
                            <?= Util\Helper::select('notify', [['id'=>'0','label'=>'No'],['id'=>'1','label'=>'Yes']], ['value'=>'id', 'class'=>'form-control', 'data-dropdrown'=>true, 'required'=>true], function($data) {
                                return $data['label'];
                            }) ?>
                            <span class="input-group-addon">
                                <span class="">Notify Me</span>
                            </span>

                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel-footer ">
                                <button type="submit" class="btn btn-primary btn-themed">
                                    <?=Resource\Label::General("Request Predictions")?>
                                </button>

                                <a href="/template" class="btn btn-primary btn-themed">
                                    <?=Resource\Label::General("View/Create My Prediction Templates")?>
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
                            <div class="table-responsive">
                                <table class="table table-bordered fixtureTable" id="dataTable">
<!--                                    <thead class="thead-inverse">-->
<!--                                    <tr class=table-header">-->
<!--                                        <th class="txt-capitalized text-center"></th>-->
<!--                                    </tr>-->
<!--                                    </thead>-->
                                    <tbody>
                                        <?php foreach ($predictionRequest as $request ): ?>
<!--                                            <tr>-->
<!--                                                <td>-->
                                                <div class="d-flex cardHolder" title="<?=ucfirst($request->description)?> | <?=$request->configuration->description?>">
                                                    <div class="card m-2 <?=\Util\Helper::GetPredictionToBorder($request->status->code == 'CNP' ? 200 : 100)?>" style="">
                                                        <div class="row g-0">
                                                            <div class="col-sm-12">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">#<?=$request->id?> <?=$request->status->name?> | <?= date('d-m-Y', strtotime($request->requestedDate))?></h5>
                                                                    <p class="card-text">
                                                                        <?=ucfirst($request->description)?>, Requested Date: <?= date('d-m-Y', strtotime($request->requestedDate))?>
                                                                        ,Template: <?=$request->configuration->name?>, (Notify) <?=$request->notify == \Helper\Check::$True ? 'Yes' : 'No'?>
                                                                    </p>
                                                                    <div class="card-text">
                                                                        <?php if($request->status->code == 'CNP') : ?>
                                                                            <a target="_blank" class="tb-action" title="View Predictions" href="/prediction?requestcode=<?=$request->id?>" >
                                                                                <span class="fa fa-list-alt action-icon"></span> Games
                                                                            </a>
                                                                            <a target="_blank" class="tb-action" title="Create Coupons" href="/coupons/index/<?=$request->id?>?oddDifference=0&numberOfGamesPerCoupon=10&numberOfGamesPerLeague=1&leaguePointPercentageOverOREqual=0&gameMotivation=0&h2hPercentage=0&gameLocation=0&options%5B%5D=Win_at&options%5B%5D=Win%2FDraw_at&options%5B%5D=Draw_at&allowedDuplicateGame=2" >
                                                                                <span class="glyphicon glyphicon-edit action-icon"></span> Coupons
                                                                            </a>
                                                                        <?php endif ?>
                                                                        <a class="tb-action" title="<?=$request->views?> Views" href="/coupons/index/<?=$request->id?>?oddDifference=0&numberOfGamesPerCoupon=10&numberOfGamesPerLeague=1&leaguePointPercentageOverOREqual=0&gameMotivation=0&h2hPercentage=0&gameLocation=0&options%5B%5D=Win_at&options%5B%5D=Win%2FDraw_at&options%5B%5D=Draw_at&allowedDuplicateGame=2" >
                                                                            <span class="glyphicon glyphicon-eye-open action-icon"></span><?=$request->views?> Views
                                                                        </a>
                                                                        <a class="tb-action hideOnMobile" title="Created Date">
                                                                            <span class="glyphicon glyphicon-time action-icon"></span> Created Date <?= date(DATE_SECOND_FORMAT, strtotime($request->createdDate))?>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
<!--                                                </td>-->
<!--                                            </tr>-->
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
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

        $('[data-date-max]').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
            endDate: new Date()
        });

        if($('.p-safe').length > 0) {

            setTimeout(function () {
                // alert('Reloading Page');
                location.reload(true);
            }, 10000);

        }


    })



</script>
