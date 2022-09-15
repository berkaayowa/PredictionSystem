
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class="mb-0" href="<?= BerkaPhp\Helper\Html::action('/specials')?>">
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
        <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/specials/add')?>" enctype="multipart/form-data">
        <div class="panel-body">

    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="PromotionName"> name</label>
        <div class="col-sm-12">
            <input type="text" class="form-control " name="PromotionName" id="PromotionName" placeholder="promotion name">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="PromotionDescription"> description</label>
        <div class="col-sm-12">
            <textarea data-editor="true" rows="10" class="form-control " name="PromotionDescription" id="PromotionDescription" placeholder="promotion description"></textarea>
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="PromotionHasDiscount"> has discount</label>
        <div class="col-sm-12">
            <input type="checkbox" class="checkbox " name="PromotionHasDiscount" id="PromotionHasDiscount" placeholder="promotion has discount" value="true" >
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="PromotionDiscount"> discount</label>
        <div class="col-sm-12">
            <input type="number" class="form-control " name="PromotionDiscount" id="PromotionDiscount" placeholder="promotion discount">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="PromotionStartDate"> start date</label>
        <div class="col-sm-12">
            <div class="input-group date" data-date>
                <input type="text" class="form-control " data-date data-format="YYYY-MM-DD HH:mm" name="PromotionStartDate" id="PromotionStartDate" placeholder="promotion start date">
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
            </div>
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="PromotionEndDate"> end date</label>
        <div class="col-sm-12">
            <div class="input-group date" data-date>
                <input type="text" class="form-control " data-date data-format="YYYY-MM-DD HH:mm" name="PromotionEndDate" id="PromotionEndDate" placeholder="promotion end date">
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
            </div>
        </div>
    </div>
        
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
</div>