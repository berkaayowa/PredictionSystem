
<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-header btn-brd">
                <a href="<?= BerkaPhp\Helper\Html::action('/message')?>" class="btn btn-default">
                    <i class="fa fa-list"></i> <?=Resource\Label::General("Messages")?>
                </a>

                <a class="btn btn-default pull-right" data-back-link>
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    <?=Resource\Label::General("Back")?>
                </a>
            </div>
            <div class="box-body">
                <form id="userForm" message="Processing..." request-type="POST" data-request="<?= BerkaPhp\Helper\Html::action('/message/add')?>">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <div class="form-group">
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <div class="form-label-group">
                                                <label for="firstName">Message Type</label>
                                                <?= Util\Helper::select('messageTypeId', $messageTypes, ['value'=>'messageTypeId', 'class'=>'form-control', 'data-dropdrown'=>true], function($data) {
                                                    return $data['name'];
                                                }) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-12 form-group">
                                            <div class="form-label-group">
                                                <label for="firstName">Contact</label>
                                                <?= Util\Helper::select('contactId[]', $contacts, ['value'=>'contactId', 'class'=>'form-control', 'multiple'=>'multiple', 'data-static-dropdown'=>true], function($data) {
                                                    return $data['name'].' '.$data['surname'];
                                                }) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <div class="form-label-group">
                                                <label for="lastName">Message</label>
                                                <textarea rows="5" class="form-control" required="" name="contentTemplate" id="contentTemplate"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-5">
                                <div class="col-md-12 form-group">
                                    <div class="form-group">
                                        <label for="API">Contact Parameters</label>
                                        <div class="input-group">
                                            <a class="btn btn-default paramBtn" name="{{name}}">
                                                Name
                                            </a>
                                            <a class="btn btn-default paramBtn" name="{{surname}}">
                                                Surname
                                            </a>
                                            <a class="btn btn-default paramBtn" name="{{emailAddress}}">
                                                Email Address
                                            </a>
                                            <a class="btn btn-default paramBtn" name="{{dob}}">
                                                Date Of Birth
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="form-group">
                                        <label for="API">Campaign Parameters</label>
                                        <div class="input-group">
                                            <a class="btn btn-default paramBtn" name="{{title}}">
                                                Title
                                            </a>
                                            <a class="btn btn-default paramBtn" name="{{startDate}}">
                                                Start Date
                                            </a>
                                            <a class="btn btn-default paramBtn" name="{{endDate}}">
                                                End Date
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">
                            <?=Resource\Label::General("Save", '', true)?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('.paramBtn').on('click', function(e) {

            var name = $(this).attr('name');
            var val = $('#contentTemplate').val();
            $('#contentTemplate').val(val + name + ' ');
            $('#contentTemplate').focus();
        })

    })

</script>