<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default ">
            <div class="box-body row ">
                <div class=" col-sm-12 colFrmSearch">
                    <form class="frmSearch row" message="<?=Resource\Label::General("Requesting")?>..."  request-type="POST" id="request" data-request="<?= BerkaPhp\Helper\Html::action('/prediction/requestprediction')?>">
                        <div class="form-group col-sm-3 col-md-3 no-mg-b">
                            <div class="input-group">
                                <input autocomplete="off" data-date="<?=DATE_SECOND_FORMAT?>" placeholder="<?=Resource\Label::General("Fixtures Date")?>" type="text" class="form-control" name="date" id="date">
                                <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                            </div>
                        </div>

                        <div class="form-group col-sm-3 col-md-3 no-mg-b">
                            <?= Util\Helper::select('configuration', $pconfig, ['value'=>'id', 'class'=>'form-control', 'data-dropdrown'=>true, 'required'=>true], function($data) {
                                if(empty($data['description']))
                                    return $data['name'];
                                else
                                    return $data['description'];
                            }) ?>
                        </div>

                        <div class="form-group col-sm-3 col-md-2 no-mg-b">
                            <div class="input-group">
                            <?= Util\Helper::select('notify', [['id'=>'0','label'=>'No'],['id'=>'1','label'=>'Yes']], ['value'=>'id', 'class'=>'form-control', 'data-dropdrown'=>true, 'required'=>true], function($data) {
                                return $data['label'];
                            }) ?>
                                <span class="input-group-addon">
                                    <span class="">Notify Me</span>
                                </span>

                            </div>
                        </div>

                        <div class="form-group col-sm-3 col-md-4 no-mg-b">
                            <div class="row">

                                <div class="col-sm-12 col-md-6">
                                    <a class="full-width btn btn-primary">
                                        <?=Resource\Label::General("View Template Details")?>
                                    </a>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <button type="submit" class="full-width btn btn-primary">
                                        <?=Resource\Label::General("Request Predictions")?>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                                    <thead class="thead-inverse">
                                    <tr class=table-header">
                                        <th class="txt-capitalized text-center">#</th>
                                        <th class="txt-capitalized text-center">Fixtures Date</th>
                                        <th class="txt-capitalized text-center">Created Date</th>
                                        <th class="txt-capitalized text-center">Status</th>
                                        <th class="txt-capitalized text-center">Configuration</th>
                                        <th class="txt-capitalized text-center">Notify</th>
                                        <th class="txt-capitalized text-center hideOnMobile">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($predictionRequest as $request ): ?>
                                            <tr>
                                                <td class="txt-capitalized text-center <?=\Util\Helper::GetPredictionToBorder($request->status->code == 'CNP' ? 200 : 100)?>">
                                                    <lable class="width_100px"><?=$request->id?></lable>
                                                </td>
                                                <td class="txt-capitalized text-center <?=\Util\Helper::GetPredictionToBorder($request->status->code == 'CNP' ? 200 : 100)?>">
                                                    <?= date('d/m/Y', strtotime($request->requestedDate))?>
                                                </td>
                                                <td class="txt-capitalized text-center <?=\Util\Helper::GetPredictionToBorder($request->status->code == 'CNP' ? 200 : 100)?>">
                                                    <?= date(DATE_SECOND_FORMAT, strtotime($request->createdDate))?>
                                                </td>
                                                <td class="txt-capitalized text-center <?=\Util\Helper::GetPredictionToBorder($request->status->code == 'CNP' ? 200 : 100)?>">
                                                    <?=$request->status->name?>
                                                </td>
                                                <td class="txt-capitalized text-center <?=\Util\Helper::GetPredictionToBorder($request->status->code == 'CNP' ? 200 : 100)?>">
                                                    <?=$request->configuration->description?>
                                                </td>
                                                <td class="txt-capitalized text-center <?=\Util\Helper::GetPredictionToBorder($request->status->code == 'CNP' ? 200 : 100)?>">
                                                    <?=$request->notify == \Helper\Check::$True ? 'Yes' : 'No'?>
                                                </td>

                                                <td  style="" class="txt-capitalized text-center <?=\Util\Helper::GetPredictionToBorder($request->status->code == 'CNP' ? 200 : 100)?>">

                                                    <?php if($request->status->code == 'CNP') : ?>
                                                        <a target="_blank" title="View Predictions" href="/prediction?requestcode=<?=$request->id?>" >
<!--                                                            <button type="button" class="btn btn-default btn viewPredictionBtn">-->
                                                               <span class="glyphicon glyphicon-eye-open action-icon"></span> View Predictions
<!--                                                            </button>-->
                                                        </a>
                                                    <?php elseif($request->status->code == 'PG') : ?>
<!--                                                        <a title="View Predictions">-->
<!--                                                            <button type="button" class="btn btn-default btn viewPredictionBtn">Delete</button>-->
<!--                                                        </a>-->
                                                    <?php endif ?>

                                                </td>
                                            </tr>
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

</script>
