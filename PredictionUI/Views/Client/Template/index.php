
<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-header btn-brd">
                <div class="row">
                    <div class="col-sm-6 col-md-6">

                    </div>
                    <div class="col-sm-6 col-md-6 text-right">
                        <a href="/template/update" class="btn btn-default">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> <?=Resource\Label::General("Create New Template")?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if(true): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered fixtureTable" id="dataTable">
                                    <thead class="thead-inverse">
                                    <tr class=table-header">
                                        <th class="txt-capitalized text-center">#</th>
                                        <th class="txt-capitalized text-center">Name</th>
                                        <th class="txt-capitalized text-center">Description</th>
                                        <th class="txt-capitalized text-center">Created Date</th>
                                        <th class="txt-capitalized text-center hideOnMobile">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($predictionTemplates as $template ): ?>
                                            <tr>
                                                <td class="txt-capitalized text-center <?=\Util\Helper::GetPredictionToBorder(-100)?>">
                                                    <lable class="width_100px"><?=$template->id?></lable>
                                                </td>
                                                <td class="txt-capitalized text-center <?=\Util\Helper::GetPredictionToBorder(-100)?>">
                                                    <?=\Util\Helper::DisplayLabel(20, $template->name)?>
                                                </td>
                                                <td class="txt-capitalized text-center <?=\Util\Helper::GetPredictionToBorder(-100)?>">
                                                    <?=\Util\Helper::DisplayLabel(20, $template->description)?>
                                                </td>
                                                <td class="txt-capitalized text-center <?=\Util\Helper::GetPredictionToBorder(-100)?>">
                                                    <?= date(DATE_SECOND_FORMAT, strtotime($template->createdDate))?>
                                                </td>
                                                <td  style="" class="txt-capitalized text-center <?=\Util\Helper::GetPredictionToBorder(-100)?>">
                                                    <a class="tb-action" title="Edit Prediction Template" href="/template/update/<?=$template->id?>" >
                                                        <span class="glyphicon glyphicon-edit action-icon"></span> View / Edit
                                                    </a>
                                                    <a title="Delete Prediction Template" class="tb-action">
                                                        <span class="glyphicon glyphicon-remove action-icon"></span> Delete
                                                    </a>
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
