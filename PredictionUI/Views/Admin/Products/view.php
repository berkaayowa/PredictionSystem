<?php $data = $template_data['product'][0]; ?>
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class=" mb-3" href="<?= BerkaPhp\Helper\Html::action('/products')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    List
                </button>
            </a>
            <a  class="mb-0" href="<?= BerkaPhp\Helper\Html::action('/products/image/'.$data['ProductID'])?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-image" aria-hidden="true"></i>
                    Manage Images
                </button>
            </a>
        </div>
    </div>
</div>

<div class="">
    <div class="panel panel-default">
        <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/products/edit/'.$data['ProductID'])?>" enctype="multipart/form-data">
            <div class="panel-body">

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="ProductShortName">product short name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control " name="ProductShortName" id="ProductShortName" value="<?=$data["ProductShortName"]?>" placeholder="product short name">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="ProductFullName">product full name</label>
                    <div class="col-sm-12">
                        <textarea data-editor="true" rows="10" class="form-control " name="ProductFullName" id="ProductFullName" placeholder="product full name"><?=$data["ProductFullName"]?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="ProductDescription">product description</label>
                    <div class="col-sm-12">
                        <textarea data-editor="true" rows="10" class="form-control " name="ProductDescription" id="ProductDescription" placeholder="product description"><?=$data["ProductDescription"]?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="RefBrandID">ref brand i d</label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control " name="RefBrandID" id="RefBrandID" value="<?=$data["RefBrandID"]?>" placeholder="ref brand i d">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="RefCategoryID">ref category i d</label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control " name="RefCategoryID" id="RefCategoryID" value="<?=$data["RefCategoryID"]?>" placeholder="ref category i d">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="ProductPrice">product price</label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control " name="ProductPrice" id="ProductPrice" value="<?=$data["ProductPrice"]?>" placeholder="product price">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="IsOnPromotion">is on promotion</label>
                    <div class="col-sm-12">
                        <input type="checkbox" class="checkbox " name="IsOnPromotion" id="IsOnPromotion" placeholder="is on promotion" value="true" <?=$data["IsOnPromotion"] == "1" ? "checked=true" : ""?>>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="RefPromotionID">ref promotion i d</label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control " name="RefPromotionID" id="RefPromotionID" value="<?=$data["RefPromotionID"]?>" placeholder="ref promotion i d">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="InStock">in stock</label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control " name="InStock" id="InStock" value="<?=$data["InStock"]?>" placeholder="in stock">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="IsProductActive">is active</label>
                    <div class="col-sm-12">
                        <input type="checkbox" class="checkbox " name="IsProductActive" id="IsProductActive" placeholder="is active" value="true" <?=$data["IsProductActive"] == "1" ? "checked=true" : ""?>>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="IsBrandNew">is brand new</label>
                    <div class="col-sm-12">
                        <input type="checkbox" class="checkbox " name="IsBrandNew" id="IsBrandNew" placeholder="is brand new" value="true" <?=$data["IsBrandNew"] == "1" ? "checked=true" : ""?>>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="AddedDateTime">added date time</label>
                    <div class="col-sm-12">
                        <div class="input-group date" data-date>
                            <input type="text" class="form-control " data-date data-format="YYYY-MM-DD HH:mm" name="AddedDateTime" id="AddedDateTime" value="<?=$data["AddedDateTime"]?>" placeholder="added date time">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="panel-footer">
                <input type="hidden" name="ProductID" value="<?=$data['ProductID']?>">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div
