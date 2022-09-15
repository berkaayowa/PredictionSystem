

<?php $data = $template_data['user'][0]; ?>
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class="mb-0" href="<?= BerkaPhp\Helper\Html::action('/users')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    List
                </button>
            </a>
        </div>
    </div>
</div>

<div class="">
    <div class="panel panel-default">
        <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/users/edit/'.$data['UserID'])?>" enctype="multipart/form-data">
<!--        <div class="panel-body">-->
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="LastName">last name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control " name="LastName" id="LastName" value="<?=$data["LastName"]?>" placeholder="last name">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="FirstName">first name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control " name="FirstName" id="FirstName" value="<?=$data["FirstName"]?>" placeholder="first name">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="UserRoleID">user Right</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="UserRoleID" name="UserRoleID">
                            <?php $rights = Rep::GetUserRights();?>
                            <?php foreach($rights as $right) :?>
                                <?php $selected = $data["UserRoleID"] == $right['ID'] ? "selected" : ""?>
                                <?php if($right['ID'] == CUSTOMER &&  BerkaPhp\Helper\Auth::GetActiveUser(true, "UserRoleID") == STUFF) :?>
                                    <option <?=$selected?> value="<?=$right['ID']?>"><?=$right['Name']?></option>
                                <?php elseif(in_array($right['ID'], [CUSTOMER, STUFF]) &&  BerkaPhp\Helper\Auth::GetActiveUser(true, "UserRoleID") == ADMIN):?>
                                    <option <?=$selected?> value="<?=$right['ID']?>"><?=$right['Name']?></option>
                                <?php elseif(in_array($right['ID'], [CUSTOMER, STUFF, ADMIN, DEVELOPER]) &&  BerkaPhp\Helper\Auth::GetActiveUser(true, "UserRoleID") == DEVELOPER):?>
                                    <option <?=$selected?> value="<?=$right['ID']?>"><?=$right['Name']?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="Phone">phone</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control " name="Phone" id="Phone" value="<?=$data["Phone"]?>" placeholder="phone">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="Email">email</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control " name="Email" id="Email" placeholder="email" value="<?=$data["Email"]?>">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-12">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group row">
                            <label class="control-label brk-php-label col-sm-12" for="IsVerified">is verified</label>
                            <div class="col-sm-12">
                                <input type="checkbox" class="checkbox " name="IsVerified" id="IsVerified" placeholder="is verified" value="true" <?=$data["IsVerified"] == "1" ? "checked=true" : ""?>>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group row">
                            <label class="control-label brk-php-label col-sm-12" for="RequirePasswordChange">Require Password Change</label>
                            <div class="col-sm-12">
                                <input type="checkbox" class="checkbox " name="RequirePasswordChange" id="RequirePasswordChange" placeholder="is verified" value="true" <?=$data["RequirePasswordChange"] == "1" ? "checked=true" : ""?>>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group row">
                            <label class="control-label brk-php-label col-sm-12" for="CanLogIn">can log in</label>
                            <div class="col-sm-12">
                                <input type="checkbox" class="checkbox " name="CanLogIn" id="CanLogIn" placeholder="can log in" value="true" <?=$data["CanLogIn"] == "1" ? "checked=true" : ""?>>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <input type="hidden" name="UserID" value="<?=$data['UserID']?>">
                <button type="submit" class="btn btn-primary">Save change</button>
            </div>
            <div class="col-sm-12 col-md-6">

            </div>
        </div>
        </form>
    </div>
</div
