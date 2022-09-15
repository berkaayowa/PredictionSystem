
<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-header  btn-brd">
                <a class="btn btn-default" message="Loading..." data-action="<?= BerkaPhp\Helper\Html::action('/contacts/edit')?>">
                    <i class="fa fa-plus-circle"></i> <?=Resource\Label::General("New Contact")?>
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
                                    <th class="txt-capitalized">Name
                                    <th class="txt-capitalized">Surname</th>
                                    <th class="txt-capitalized">Cell Phone </th>
                                    <th class="txt-capitalized">Emil Address</th>
                                    <th class="txt-capitalized">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(sizeof($contacts) > 0): ?>
                                    <?php foreach ($contacts as $contact ): ?>
                                        <tr>
                                            <td><?=$contact->contactId?></td>
                                            <td class="txt-capitalized"><?=$contact->name?>
                                            <td class="txt-capitalized"><?=$contact->surname?></td>
                                            <td class=""><?=$contact->cellPhone?></td>
                                            <td class=""><?=$contact->emailAddress?></td>

                                            <td class="txt-capitalized">
                                                <a message="Loading..." data-action="<?= BerkaPhp\Helper\Html::action('/contacts/edit/'.$contact->contactId)?>">
                                                   View / Edit
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
        mts.initAction();
    });
</script>

<div class="action-wrapper">

</div>


