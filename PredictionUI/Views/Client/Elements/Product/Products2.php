
<?php if(sizeof($model['products']) > 0) :?>
    <?php foreach($model['products'] as $product) :?>
        <div class="item item-carousel">
            <div class="products">
                <div class="product">
                    <div class="product-image">
                        <div class="image">
                            <a href="/products/view/<?= $product['ProductID']?>">
                                <img src="<?=$product["ProductMainImage"] != null ? $product["ProductMainImage"] : '/Views/Client/Assets/no-image.png' ?>" alt="">
                            </a>
                        </div>
                        <div class="tag sale">
                            <span>sale</span>
                        </div>
                    </div>
                    <div class="product-info text-left">
                        <h3 class="name">
                            <a href="/products/view/<?= $product['ProductID']?>"><?=\BerkaPhp\Helpertr::limitChar($product['ProductShortName'],25)?></a>
                        </h3>
                        <div class="rating rateit-small"></div>
                        <div class="description"></div>
                        <div class="product-price">
                            <span class="price"><?= BerkaPhp\HelperCurrency::Init($product['ProductPrice'])->toString()?></span>
                            <span class="price-before-discount"><?= BerkaPhp\HelperCurrency::Init($product['ProductPrice'])->toString()?></span>
                        </div>
                    </div>
                    <div class="cart clearfix animate-effect">
                        <div class="action">
                            <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                    <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                </li>
                                <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach?>
<?php endif?>