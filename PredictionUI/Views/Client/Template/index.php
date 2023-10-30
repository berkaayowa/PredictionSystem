<?=\BerkaPhp\Helper\Element::Render("Breadcrumb", "Client", array("breadcrumb"=>$breadcrumb))?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1">My Prediction Templates</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                    <div class="box  box-default ">
                        <div class="box-body ">
                            <p class="pSubHeaderx">
                                Empower your soccer predictions using your own templates! Optimize match analysis with expertly crafted tools.
                                Click "Create Template" for custom ones and seamlessly integrate team variables that matter. these templates provide a winning advantage.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-header btn-brd">

                <a href="/template/update" class="btn btn-default ">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> <?=Resource\Label::General("Create Template")?>
                </a>
                <a class="btn btn-default pull-right hide" data-back-link>
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    <?=Resource\Label::General("Back")?>
                </a>

            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if(true): ?>
                            <div class="">
                                    <tbody>
                                        <?php foreach ($predictionTemplates as $template ): ?>

                                            <div class="d-flex cardHolder " title="<?=ucfirst($template->name)?>">
                                                <div class="card m-2" style="">
                                                    <div class="row g-0">
                                                        <div class="col-sm-12">
                                                            <div class="card-body">
                                                                <h5 class="card-title">
                                                                    #<?=$template->id?> | <?=ucfirst($template->name)?> | Created On <?= date(DATE_SECOND_FORMAT, strtotime($template->createdDate))?>
                                                                    | Created By <a><span class="glyphicon glyphicon-user "></span> <?=ucfirst($template->user->name)?> <?=ucfirst($template->user->surname)?></a>
                                                                </h5>
                                                                <p class="card-text">
                                                                    <?=$template->description?>
                                                                </p>
                                                                <div class="card-text action-holder">
                                                                    <a class="tb-action" title="Edit Prediction Template" href="/template/update/<?=$template->id?>">
                                                                        <span class="glyphicon glyphicon-edit action-icon"></span>View / Edit
                                                                    </a>

                                                                    <a data-ajax-confirmation confirmation-title="Confirmation" confirmation-message="Please confirm to duplicate this template (<?=ucfirst($template->name)?>)" class="tb-action" title="Duplicate This Template" href="/template/duplicate/<?=$template->id?>">
                                                                        <span class="glyphicon glyphicon-save action-icon"></span>Duplicate Template
                                                                    </a>

                                                                    <a data-ajax-confirmation confirmation-title="Confirmation" confirmation-message="Please confirm to delete (<?=ucfirst($template->name)?>)" class="tb-action" title="Delete This Template" href="/template/delete/<?=$template->id?>">
                                                                        <span class="glyphicon glyphicon-remove action-icon"></span> Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
