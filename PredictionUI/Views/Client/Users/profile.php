<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-header btn-brd">
                <a id="GenKey" title="Generate new auth key"  class="btn btn-default">
                    <i class="fa fa-key" aria-hidden="true"></i> Generate New Api key
                </a>
                <a class="btn btn-default pull-right" data-back-link>
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    <?=Resource\Label::General("Back")?>
                </a>
            </div>
            <div class="box-body">
                <form id="userForm" message="Updating users information..." request-type="POST" data-request="<?= BerkaPhp\Helper\Html::action('/users/update')?>">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <div class="form-group">
                                    <div class="row form-group">
                                        <div class="col-md-6">
                                            <div class="form-label-group">
                                                <label for="firstName">First name</label>
                                                <input type="text" id="name" name="name" class="form-control" required="required" value="<?=$user->name?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-label-group">
                                                <label for="lastName">Last name</label>
                                                <input type="text" id="surname" name="surname" class="form-control" value="<?=$user->surname?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-6 form-group">
                                            <div class="form-label-group">
                                                <label for="firstName">Cell phone</label>
                                                <input type="text" disabled class="form-control" value="<?=$user->phone?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <div class="form-label-group">
                                                <label for="lastName">Email</label>
                                                <input type="text" id="email" disabled class="form-control" value="<?=$user->email?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <div class="form-label-group">
                                                <label for="lastName">Account Number</label>
                                                <input type="text" disabled class="form-control" value="<?=$user->accountNumber?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <div class="form-label-group">
                                                <label for="lastName">Password</label>
                                                <input type="text" disabled class="form-control" value="*********">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-5">
                                <div class="col-md-12 form-group">
                                    <div class="form-group">
                                        <label for="API">API AuthKey</label>
                                        <input type="text"  class="form-control" id="authkey" name="authkey" value="<?=$user->authKey?>" />
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
//        mts.initGenerateAuthKey('#authkey', '#GenKey');
    })

</script>