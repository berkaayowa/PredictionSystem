
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class="mb-0" href="<?= BerkaPhp\Helper\Html::action('/pages')?>">
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
        <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/pages/add')?>" enctype="multipart/form-data">
        <div class="panel-body">

        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="Title">title</label>
            <div class="col-sm-12">
                <input type="text" class="form-control " name="Title" id="Title" placeholder="title">
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="Content">content</label>
            <div class="col-sm-12">
                <textarea data-editor="true" rows="10" class="form-control " name="Content" id="Content" placeholder="content"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="IsVisible">is visible</label>
            <div class="col-sm-12">
                <input type="checkbox" class="checkbox " name="IsVisible" id="IsVisible" placeholder="is visible" value="true" >
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="Link">link</label>
            <div class="col-sm-12">
                <input type="text" class="form-control " name="Link" id="Link" placeholder="link">
            </div>
        </div>
        
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
</div>