<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class="mb-0" href="<?= BerkaPhp\Helper\Html::action('/products')?>">
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
        <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/products/add')?>" enctype="multipart/form-data">
        <div class="panel-body">

    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="ProductShortName">product short name</label>
        <div class="col-sm-12">
            <input type="text" class="form-control " name="ProductShortName" id="ProductShortName" placeholder="product short name">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="ProductFullName">product full name</label>
        <div class="col-sm-12">
            <input type="text" class="form-control " name="ProductFullName" id="ProductFullName" placeholder="product full name">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="ProductDescription">product description</label>
        <div class="col-sm-12">
            <textarea data-editor="true" rows="10" class="form-control " name="ProductDescription" id="ProductDescription" placeholder="product description"></textarea>
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="RefBrandID">Brand</label>
        <div class="col-sm-12">
            <input type="number" data-select data-type ="Brands" data-value="BrandID" data-text="BrandName"  class="form-control " name="RefBrandID" id="RefBrandID">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="RefCategoryID">Category</label>
        <div class="col-sm-12">
            <input type="number" data-select data-type ="Categories" data-value="CatID" data-text="CatName" class="form-control " name="RefCategoryID" id="RefCategoryID">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="ProductPrice">product price</label>
        <div class="col-sm-12">
            <input type="number" class="form-control " name="ProductPrice" id="ProductPrice" placeholder="product price">
        </div>
    </div>
        
<!--    <div class="form-group row">-->
<!--        <label class="control-label brk-php-label col-sm-12" for="IsOnPromotion">is on promotion</label>-->
<!--        <div class="col-sm-12">-->
<!--            <input type="checkbox" class="checkbox " name="IsOnPromotion" id="IsOnPromotion" placeholder="is on promotion" value="true" >-->
<!--        </div>-->
<!--    </div>-->
<!--        -->
<!--    <div class="form-group row">-->
<!--        <label class="control-label brk-php-label col-sm-12" for="RefPromotionID">ref promotion i d</label>-->
<!--        <div class="col-sm-12">-->
<!--            <input type="number" class="form-control " name="RefPromotionID" id="RefPromotionID" placeholder="ref promotion i d">-->
<!--        </div>-->
<!--    </div>-->
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="InStock">in stock</label>
        <div class="col-sm-12">
            <input type="number" class="form-control " name="InStock" id="InStock" placeholder="in stock">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="IsProductActive">is active</label>
        <div class="col-sm-12">
            <input type="checkbox" class="checkbox " name="IsProductActive" id="IsProductActive" placeholder="is active" value="true" >
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-12" for="IsBrandNew">is brand new</label>
        <div class="col-sm-12">
            <input type="checkbox" class="checkbox " name="IsBrandNew" id="IsBrandNew" placeholder="is brand new" value="true" >
        </div>
    </div>
        
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
</div>