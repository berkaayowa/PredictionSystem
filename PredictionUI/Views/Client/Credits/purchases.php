<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-body row">
                <form class="frmSearch" message="<?=Resource\Label::General("Searching")?>..."  method="GET" id="transactionSearch" ACTION="<?= BerkaPhp\Helper\Html::action('/transactions/index')?>">
                    <div class="form-group col-sm-12 col-md-2 no-mg-b">
                        <div class="input-group">
                            <input value="<?=""?>"  data-date="<?=DATE_SECOND_FORMAT?>" placeholder="<?=Resource\Label::General("StartDate")?>" type="text" class="form-control" name="StartDate" id="StartDate">
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 col-md-2 no-mg-b">
                        <div class="input-group">
                            <input autocomplete="false" value="<?=""?>"  data-date="<?=DATE_SECOND_FORMAT?>" placeholder="<?=Resource\Label::General("EndDate")?>" type="text" class="form-control" name="EndDate" id="EndDate">
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 col-md-2 no-mg-b">
                        <button type="submit" class="btn btn-primary w-45 pull-left">
                            <?=Resource\Label::General("Search")?>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-header hidden">

            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable">
                                <thead class="thead-inverse">
                                <tr class=table-header">
                                    <th>#</th>
                                    <th class="txt-capitalized">credits</th>
                                    <th class="txt-capitalized">(R) total amount</th>
                                    <th class="txt-capitalized">Date </th>
                                    <th class="txt-capitalized">Payment method</th>
                                    <th class="txt-capitalized">status</th>
                                    <th class="txt-capitalized">option</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(sizeof($purchases) > 0): ?>
                                    <?php foreach ($purchases as $purchase ): ?>
                                        <tr class="<?=$purchase->status->code == 'SCS' ? 'green' : ''?> <?=$purchase->status->code == 'CNL' ? 'red' : ''?>">
                                            <td><?=$purchase->id?></td>
                                            <td class="txt-capitalized"><?=$purchase->credits?></td>
                                            <td class="txt-capitalized"><?=$purchase->amount?></td>
                                            <td class="txt-capitalized"><?=$purchase->createdDate?></td>
                                            <td class="txt-capitalized"><?=$purchase->method->name?></td>
                                            <td class="txt-capitalized"><?=$purchase->status->name?></td>
                                            <td class="txt-capitalized">
                                                <?php if($purchase->status->code == 'PNP'):?>
                                                    <?php if($purchase->method->code == 'EFT'):?>
                                                        <a class=" buy-btn" title="Pay now" href="<?= BerkaPhp\Helper\Html::action('/credits/checkout/'.$purchase->id)?>">
                                                            Pay Credit Now
                                                        </a>
                                                    <?php endif?>
                                                    <?php if($purchase->method->code == 'DPS'):?>
                                                        <a class="buy-btn" title="Notify now" href="<?= BerkaPhp\Helper\Html::action('/credits/notification/'.$purchase->id)?>">
                                                            Notify Payment Now
                                                        </a>
                                                    <?php endif?>
                                                <?php endif?>
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
