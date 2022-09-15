
<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-header ">
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3><?=$summary['creditUsed']?>
                                    <sup style="font-size: 20px">credits</sup>
                                </h3>
                                <p>Credits Used</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <span class="small-box-footer">
                                &nbsp;
                            </span>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>
                                    <?=$summary['smsCount']?>
                                    <sup style="font-size: 20px">sms</sup>
                                </h3>
                                <p>Number of SMS/s sent</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="<?= BerkaPhp\Helper\Html::action('/message')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>
                                    <?=$summary['smsRepliesCount']?>
                                    <sup style="font-size: 20px">sms replies</sup>
                                </h3>
                                <p>Number of SMS replies</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3><?=$summary['smsFailedCount']?></h3>
                                <p>Unsuccessful SMS/s</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-header ">
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
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

<script>
    $(document).ready(function() {
//        mts.InitChart();

    })
</script>
