<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class="mb-0" href="<?= BerkaPhp\Helper\Html::action('/roles')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    List
                </button>
            </a>
        </div>
    </div>
</div>
<?php $data = $template_data['user_role'][0]; ?>
<div class="">
    <div class="panel panel-default">
        <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/roles/edit/'.$data['ID'])?>" enctype="multipart/form-data">
        <div class="panel-body">
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="Name">name</label>
        <div class="col-sm-12">
            <input type="text" class="form-control " name="Name" id="Name" value="<?=$data["Name"]?>" placeholder="name">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="Description">description</label>
        <div class="col-sm-12">
            <input type="text" class="form-control " name="Description" id="Description" value="<?=$data["Description"]?>" placeholder="description">
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
