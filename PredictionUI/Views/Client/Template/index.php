
<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default ">
            <div class="box-body ">
                <h3 class="headerFocus">My Prediction Templates</h3>
                <p class="pSubHeaderx">
                    Empower your soccer predictions using your own templates! Optimize match analysis with expertly crafted tools.
                    Click "Create Template" for custom ones and seamlessly integrate team variables that matter. these templates provide a winning advantage.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-header btn-brd">

                <a href="/template/update" class="btn btn-default">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> <?=Resource\Label::General("Create Template")?>
                </a>
                <a class="btn btn-default pull-right" data-back-link>
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    <?=Resource\Label::General("Back")?>
                </a>

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
