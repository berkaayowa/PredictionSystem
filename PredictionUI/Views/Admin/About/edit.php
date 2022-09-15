<?php $data = $template_data['abou'][0]; ?>
<div class="">
    <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/about/edit/'.$data['ID'])?>" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="Title">Title</label>
            <div class="col-sm-12">
                <input type="text" class="form-control " name="Title" id="Title" value="<?=$data["Title"]?>" placeholder="title">
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="Content">Content</label>
            <div class="col-sm-12">
                <textarea data-editor="true" rows="10" class="form-control " name="Content" id="Content" placeholder="content"><?=$data["Content"]?></textarea>
            </div>
        </div>

        <div class="col-sm-12 pl-0">
            <input type="hidden" name="ID" value="<?=$data['ID']?>">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div
