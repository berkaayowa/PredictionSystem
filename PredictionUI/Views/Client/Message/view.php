

<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-header btn-brd">
                <a href="<?= BerkaPhp\Helper\Html::action('/message')?>" class="btn btn-default">
                    <i class="fa fa-list"></i> <?=Resource\Label::General("Messages")?>
                </a>

                <a href="<?= BerkaPhp\Helper\Html::action('/message/add')?>" class="btn btn-default">
                    <i class="fa fa-plus-circle"></i> <?=Resource\Label::General("New Message")?>
                </a>
                <a class="btn btn-default pull-right" data-back-link>
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    <?=Resource\Label::General("Back")?>
                </a>
            </div>
            <div class="box-body">
                <form id="userForm" message="Processing..." request-type="POST" data-request="<?= BerkaPhp\Helper\Html::action('/message/addx')?>">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <div class="form-group">
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <div class="form-label-group">
                                                <label for="firstName">Message Type</label>
                                                <input type="text" disabled class="form-control" value="<?=$smessage->type->name?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-12 form-group">
                                            <div class="form-label-group">
                                                <label for="firstName">Destination</label>
                                                <input type="text" disabled class="form-control" value="<?= Util\ISendHelper::GetMessageDestination($smessage)?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <div class="form-label-group">
                                                <label for="lastName">Message</label>
                                                <textarea rows="5" disabled class="form-control" required="" name="content" id="content"><?=$smessage->content?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-5">
                                <label for="firstName">Logs</label>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="thead-inverse">
                                        <tr class="table-header">
                                            <th>#</th>
                                            <th><?=Resource\Label::General("Description")?></th>
                                            <th><?=Resource\Label::General("Time")?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($msLogs as $mlog): ?>
                                            <tr>
                                                <td><?=$mlog->logId?></td>
                                                <td><?=$mlog->logMessage?></td>
                                                <td><?=$mlog->createdDate?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {


    })

</script>