<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class="mb-0" href="<?= BerkaPhp\Helper\Html::action('/brands')?>">
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
        <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/brands/add')?>" enctype="multipart/form-data">
            <div class="panel-body">

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="BrandID">brand i d</label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control " name="BrandID" id="BrandID" placeholder="brand i d">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="BrandName">brand name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control " name="BrandName" id="BrandName" placeholder="brand name">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="BrandDescription">brand description</label>
                    <div class="col-sm-12">
                        <textarea data-editor="true" rows="10" class="form-control " name="BrandDescription" id="BrandDescription" placeholder="brand description"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="BrandLogo">brand logo</label>
                    <div class="col-sm-12">
                        <input type="file" class="form-control " name="BrandLogo" id="BrandLogo" placeholder="brand logo">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="IsActive">is active</label>
                    <div class="col-sm-12">
                        <input type="checkbox" class="checkbox " name="IsActive" id="IsActive" placeholder="is active" value="true" >
                    </div>
                </div>

            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>