<div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title">Special Offer</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
            <?php
            $products = Rep::GetSpecials();

            if(sizeof($products) > 0) : ?>
                <?php foreach($products as $product) :?>
                    <div class="item">
                        <div class="products special-product">
                            <div class="product">
                                <div class="product-micro">
                                    <div class="row product-micro-row">
                                        <div class="col col-xs-5">
                                            <div class="product-image">
                                                <div class="image">
                                                    <a href="#">
                                                        <img  src="/Views/Default/Assets/images/products/p0.jpg" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-xs-7">
                                            <div class="product-info">
                                                <h3 class="name"><a href="/products/view/<?= $product['ProductID']?>/?<?=$product['ProductShortName']?>">
                                                        <?=\BerkaPhp\Helpertr::limitChar($product['ProductShortName'],25)?>
                                                    </a>
                                                </h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="product-price">
                                                    <span class="price"><?= BerkaPhp\HelperCurrency::Init($product['ProductPrice'])->toString()?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</div>