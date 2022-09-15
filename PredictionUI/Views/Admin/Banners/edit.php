<?php $data = $template_data['banner'][0]; ?>
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class="mb-0" href="<?= BerkaPhp\Helper\Html::action('/banners')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    List
                </button>
            </a>
            <a  class="mb-0" href="<?= BerkaPhp\Helper\Html::action('/banners/image/'.$data['ID'])?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-image" aria-hidden="true"></i>
                    Manage Image
                </button>
            </a>
        </div>
    </div>
</div>

<div class="">
    <div class="panel panel-default">
        <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/banners/edit/'.$data['ID'])?>" enctype="multipart/form-data">
        <div class="panel-body">

        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="Title">title</label>
            <div class="col-sm-12">
                <input type="text" class="form-control " name="Title" id="Title" value="<?=$data["Title"]?>" placeholder="title">
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="Description">description</label>
            <div class="col-sm-12">
                <textarea rows="5" class="form-control " name="Description" id="Description" placeholder="description"><?=$data["Description"]?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="DisplayDescription">display description</label>
            <div class="col-sm-12">
                <input type="checkbox" class="checkbox " name="DisplayDescription" id="DisplayDescription" placeholder="display description" value="true" <?=$data["DisplayDescription"] == "1" ? "checked=true" : ""?>>
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="DisplayButton">display button</label>
            <div class="col-sm-12">
                <input type="checkbox" class="checkbox " name="DisplayButton" id="DisplayButton" placeholder="display button" value="true" <?=$data["DisplayButton"] == "1" ? "checked=true" : ""?>>
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="ButtonCaption">button caption</label>
            <div class="col-sm-12">
                <input type="text" class="form-control " name="ButtonCaption" id="ButtonCaption" value="<?=$data["ButtonCaption"]?>" placeholder="button caption">
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="ButtonLink">button link</label>
            <div class="col-sm-12">
                <input type="text" class="form-control " name="ButtonLink" id="ButtonLink" value="<?=$data["ButtonLink"]?>" placeholder="button link">
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="IsActive">is active</label>
            <div class="col-sm-12">
                <input type="checkbox" class="checkbox " name="IsActive" id="IsActive" placeholder="is active" value="true" <?=$data["IsActive"] == "1" ? "checked=true" : ""?>>
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="BannerOrder">banner order</label>
            <div class="col-sm-12">
                <input type="number" class="form-control " name="BannerOrder" id="BannerOrder" value="<?=$data["BannerOrder"]?>" placeholder="banner order">
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
