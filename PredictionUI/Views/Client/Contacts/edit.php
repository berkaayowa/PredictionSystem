<div class="modal" data-backdrop="static" data-keyboard="false" id="actionModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content customer-modal-content">
            <div class="modal-header">
                <h3 class="inline modal-title text-center  customer-header" id="exampleModalLabel">
                    <?=$contact->IsAny() ? 'Editing ' . $contact->name : 'New contact'?>
                </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body customer-body">
                <form data-toggle="validator" message="<?=Resource\Label::General("Processing")?>..." request-type="POST" id="formUser" data-request="<?= BerkaPhp\Helper\Html::action('/contacts/add/'.($contact->IsAny() ? $contact->contactId : ''))?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="" >
                                <div class="form-group row ">
                                    <div class="col-sm-12">
                                        <label class="control-label text-left" style="text-align: right;"  for="name">
                                            <?=Resource\Label::General("Name")?>
                                        </label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input required type="text" class="form-control " name="name" id="name" value="<?=$contact->IsAny() ? $contact->name : ''?>">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-sm-12">
                                        <label class="control-label text-left" style="text-align: right;"  for="surname">
                                            <?=Resource\Label::General("Surname")?>
                                        </label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input required type="text" class="form-control " name="surname" id="surname" value="<?=$contact->IsAny() ? $contact->surname : ''?>">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-sm-12">
                                        <label class="control-label text-left" style="text-align: right;"  for="cellPhone">
                                            <?=Resource\Label::General("Cell Phone")?>
                                        </label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input required type="number" class="form-control " name="cellPhone" id="cellPhone" value="<?=$contact->IsAny() ? $contact->cellPhone : ''?>">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-sm-12">
                                        <label class="control-label text-left" style="text-align: right;"  for="emailAddress">
                                            <?=Resource\Label::General("Email Address")?>
                                        </label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control " name="emailAddress" id="emailAddress" value="<?=$contact->IsAny() ? $contact->emailAddress : ''?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer no-padding-right">
                        <button type="submit" class="btn btn-primary">
                            <?=Resource\Label::General("Save", "", true)?>
                        </button>
                        <a  class="btn btn-default pull-right" data-dismiss="modal">
                            <?=Resource\Label::General("Close")?>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        mts.initFormRequest();
    });
</script>