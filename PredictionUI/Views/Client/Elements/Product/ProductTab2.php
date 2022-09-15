<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
    <div class="more-info-tab clearfix ">
        <h3 class="new-product-title pull-left">New Products</h3>
        <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
            <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
            <li><a data-transition-type="backSlide" href="#Laptop" data-toggle="tab">Laptop</a></li>
            <li><a data-transition-type="backSlide" href="#Desktop" data-toggle="tab">Desktop</a></li>
            <li><a data-transition-type="backSlide" href="#PcComponents" data-toggle="tab">Pc components</a></li>
        </ul>
    </div>
    <div class="tab-content outer-top-xs">

        <div class="tab-pane in active" id="all">
            <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                    <?= BerkaPhp\Helper\Element::Render('Product/Products', 'Client', $model)?>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="Laptop">
            <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                    <?= BerkaPhp\Helper\Element::Render('Product/Products', 'Client', $model)?>
                </div>
            </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="Desktop">
            <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                    <?= BerkaPhp\Helper\Element::Render('Product/Products', 'Client', $model)?>
                </div>
            </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="PcComponents">
            <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                    <?= BerkaPhp\Helper\Element::Render('Product/Products', 'Client', $model)?>
                </div>
            </div>
        </div>

    </div>
</div>