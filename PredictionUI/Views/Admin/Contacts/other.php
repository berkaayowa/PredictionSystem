<?php $data = $template_data['contact'][0]; ?>
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class="mb-0" href="<?= BerkaPhp\Helper\Html::action('/banners')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </button>
            </a>
        </div>
    </div>
</div>

<div class="">
    <div class="panel panel-default">
        <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/contacts/edit/'.$data['ID'])?>" enctype="multipart/form-data">
            <div class="panel-body">

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="PrimaryEmail">primary email</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control " name="PrimaryEmail" id="PrimaryEmail" value="<?=$data["PrimaryEmail"]?>" placeholder="primary email">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="SecondaryEmail">secondary email</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control " name="SecondaryEmail" id="SecondaryEmail" value="<?=$data["SecondaryEmail"]?>" placeholder="secondary email">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="PrimaryTell">primary tell</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control " name="PrimaryTell" id="PrimaryTell" value="<?=$data["PrimaryTell"]?>" placeholder="primary tell">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="SecondaryTell">secondary tell</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control " name="SecondaryTell" id="SecondaryTell" value="<?=$data["SecondaryTell"]?>" placeholder="secondary tell">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="Fax">fax</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control " name="Fax" id="Fax" value="<?=$data["Fax"]?>" placeholder="fax">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="PhysicalAddress">physical address</label>
                    <div class="col-sm-12">
                        <textarea rows="4" class="form-control " name="PhysicalAddress" id="PhysicalAddress" placeholder="physical address"><?=$data["PhysicalAddress"]?></textarea>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <input type="hidden" name="ID" value="<?=$data['ID']?>">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div
