<div class="row hide">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-body row">
                <div class=" col-sm-9">
                    <form class="frmSearch row" message="<?=Resource\Label::General("Searching")?>..."  method="GET" id="transactionSearch" ACTION="<?= BerkaPhp\Helper\Html::action('/dashboard/message')?>">
                        <div class="form-group col-sm-3 col-md-3 no-mg-b">
                            <div class="input-group">
                                <input value="<?=$StartDate?>"  data-date="<?=DATE_SECOND_FORMAT?>" placeholder="<?=Resource\Label::General("StartDate")?>" type="text" class="form-control" name="StartDate" id="StartDate">
                            <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                            </div>
                        </div>
                        <div class="form-group col-sm-3 col-md-3 no-mg-b">
                            <div class="input-group">
                                <input autocomplete="false" value="<?=$EndDate?>"  data-date="<?=DATE_SECOND_FORMAT?>" placeholder="<?=Resource\Label::General("EndDate")?>" type="text" class="form-control" name="EndDate" id="EndDate">
                            <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                            </div>
                        </div>
                        <div class="form-group col-sm-3 col-md-3 no-mg-b">
                            <button type="submit" class="btn btn-primary w-45 pull-left">
                                <?=Resource\Label::General("Search")?>
                            </button>
                        </div>
                    </form>
                </div>
                <div class=" col-sm-3 right">
                    <a href="<?= BerkaPhp\Helper\Html::action('/message/add')?>" class="btn btn-primary w-45">
                        <i class="fa fa-plus-circle"></i> <?=Resource\Label::General("New Message")?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-header  btn-brd">
                <a href="<?= BerkaPhp\Helper\Html::action('/message/add')?>" class="btn btn-default">
                    <i class="fa fa-plus-circle"></i> <?=Resource\Label::General("New Message")?>
                </a>
                <a class="btn btn-default pull-right" data-back-link>
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    <?=Resource\Label::General("Back")?>
                </a>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable">
                                <thead class="thead-inverse">
                                <tr class=table-header">
                                    <th>#</th>
                                    <th class="txt-capitalized">type</th>
                                    <th class="txt-capitalized">contact</th>
                                    <th class="txt-capitalized">message</th>
                                    <th class="txt-capitalized">Date </th>
                                    <th class="txt-capitalized">credit Cost</th>
                                    <th class="txt-capitalized">Status</th>
                                    <th class="txt-capitalized">Option</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(sizeof($messages) > 0): ?>
                                    <?php foreach ($messages as $message ): ?>
                                        <tr >
                                            <td><?=$message->messageId?></td>
                                            <td><?=$message->type->name?></td>
                                            <td class="txt-capitalized"><?= Util\ISendHelper::GetMessageDestination($message)?></td>
                                            <td class="txt-capitalized">
                                                <span data-toggle="popover" title="<?=$message->content?>" data-content="<?=$message->content?>">
                                                    <?=\BerkaPhp\Helper\Str::limitChar($message->content, 25, '...')?>
                                                </span>
                                            </td>
                                            <td class="txt-capitalized"><?=$message->createdDate?></td>
                                            <td class="txt-capitalized"><?=$message->creditCost?></td>
                                            <td class="txt-capitalized"><?=$message->status->name?></td>
                                            <td class="txt-capitalized">
                                                <a href="<?= BerkaPhp\Helper\Html::action('/message/view?id='.$message->messageId)?>">
                                                    View Report
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
