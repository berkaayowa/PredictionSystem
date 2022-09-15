<?php if(sizeof(\Rep::GetBrands()) > 0) :?>
<div id="brands-carousel" class="logo-slider wow fadeInUp">
    <div class="logo-slider-inner">
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
            <?php foreach(\Rep::GetBrands() as $brand) :?>
                <?php if($brand['BrandLogo'] != null) :?>
                    <div class="item m-t-15">
                        <a href="#" class="image">
                            <img style="width: 100px;" data-echo="<?=$brand['BrandLogo']?>" src="<?=$brand['BrandLogo']?>" alt="">
                        </a>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php endif ?>