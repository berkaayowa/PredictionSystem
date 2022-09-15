
<?php $data = $template_data['product_promotion'][0]; ?>
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
        <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/specials/edit/'.$data['PromotionID'])?>" enctype="multipart/form-data">
            <div class="panel-body">

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="PromotionName">name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control " name="PromotionName" id="PromotionName" value="<?=$data["PromotionName"]?>" placeholder="promotion name">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="PromotionDescription">description</label>
                    <div class="col-sm-12">
                        <textarea data-editor="true" rows="10" class="form-control " name="PromotionDescription" id="PromotionDescription" placeholder="promotion description"><?=$data["PromotionDescription"]?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="PromotionHasDiscount">has discount</label>
                    <div class="col-sm-12">
                        <input type="checkbox" class="checkbox " name="PromotionHasDiscount" id="PromotionHasDiscount" placeholder="promotion has discount" value="true" <?=$data["PromotionHasDiscount"] == "1" ? "checked=true" : ""?>>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="PromotionDiscount">discount</label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control " name="PromotionDiscount" id="PromotionDiscount" value="<?=$data["PromotionDiscount"]?>" placeholder="promotion discount">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="PromotionStartDate">start date</label>
                    <div class="col-sm-12">
                        <div class="input-group date" data-date>
                            <input type="text" class="form-control " data-date data-format="YYYY-MM-DD HH:mm" name="PromotionStartDate" id="PromotionStartDate" value="<?=$data["PromotionStartDate"]?>" placeholder="promotion start date">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label brk-php-label col-sm-12" for="PromotionEndDate">end date</label>
                    <div class="col-sm-12">
                        <div class="input-group date" data-date>
                            <input type="text" class="form-control " data-date data-format="YYYY-MM-DD HH:mm" name="PromotionEndDate" id="PromotionEndDate" value="<?=$data["PromotionEndDate"]?>" placeholder="promotion end date">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="panel-footer">
                <input type="hidden" name="PromotionID" value="<?=$data['PromotionID']?>">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div
