<?php $data = $template_data['product_category'][0]; ?>
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class="mb-0" href="<?= BerkaPhp\Helper\Html::action('/categories')?>">
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
        <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/categories/edit/'.$data['CatID'])?>" enctype="multipart/form-data">
        <div class="panel-body">

    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="CatName">cat name</label>
        <div class="col-sm-12">
            <input type="text" class="form-control " name="CatName" id="CatName" value="<?=$data["CatName"]?>" placeholder="cat name">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="CatDescription">cat description</label>
        <div class="col-sm-12">
            <textarea data-editor="true" rows="10" class="form-control " name="CatDescription" id="CatDescription" placeholder="cat description"><?=$data["CatDescription"]?></textarea>
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="CatIcon">cat icon</label>
        <div class="col-sm-12">
            <input type="text" class="form-control " name="CatIcon" id="CatIcon" value="<?=$data["CatIcon"]?>" placeholder="cat icon">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="CatOrder">cat order</label>
        <div class="col-sm-12">
            <input type="number" class="form-control " name="CatOrder" id="CatOrder" value="<?=$data["CatOrder"]?>" placeholder="cat order">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="IsActive">is active</label>
        <div class="col-sm-12">
            <input type="checkbox" class="checkbox " name="IsActive" id="IsActive" placeholder="is active" value="true" <?=$data["IsActive"] == "1" ? "checked=true" : ""?>>
        </div>
    </div>
        
        </div>
        <div class="panel-footer">
            <input type="hidden" name="CatID" value="<?=$data['CatID']?>">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
</div
