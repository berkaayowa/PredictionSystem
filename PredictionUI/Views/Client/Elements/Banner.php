<?php if(sizeof(\Rep::GetMainBanners()) > 0) : ?>
<div id="hero">
    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
        <?php foreach(\Rep::GetMainBanners() as $banner) :?>
        <div class="item" style="background-image: url(<?= $banner['Banner'] !== null ? $banner['Banner'] : '/Views/Client/Assets/images/banners/banner-side.png'?>);">
            <div class="container-fluid">
                <?php if(BerkaPhp\Helper\Check::Boolean($banner['DisplayDescription']) == true) :?>
                    <div class="caption bg-color vertical-center text-left">
                        <div class="slider-header fadeInDown-1"></div>
                        <div class="big-text fadeInDown-1"><?= $banner['Title'] ?></div>
                        <div class="excerpt fadeInDown-2 hidden-xs">
                            <span><?= $banner['Description'] ?></span>
                        </div>
                        <?php if(BerkaPhp\Helper\Check::Boolean($banner['DisplayButton']) == true) :?>
                            <div class="button-holder fadeInDown-3">
                                <a href="<?= $banner['ButtonLink'] ?>" class="btn-lg btn btn-uppercase btn-primary shop-now-button">
                                    <?= $banner['ButtonCaption'] ?>
                                </a>
                            </div>
                        <?php endif ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>
<?php endif ?>