<div id="headerCart" data-panel="headerCart" data-ajax="/cart/cart">
    <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
        <div class="items-cart-inner">
            <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
            <div class="basket-item-count">
                <span class="count">
                    <?= $NumOfItems ?>
                </span>
            </div>
            <div class="total-price-basket">
                <span class="lbl"></span>
            <span class="total-price">
                <span class="sign">
                    <?= \BerkaPhp\HelperCurrency::Init($totalPrice)->toString()?>
                </span>
            </span>
            </div>
        </div>
    </a>
    <ul class="dropdown-menu">
        <li>
            <div class="cart-item product-summary">
                <?php if(isset($cart['Items']) && sizeof($cart['Items'])) :?>
                    <?php foreach($cart['Items'] as $item) : ?>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="image">
                                    <a href="/">
                                        <img src="<?= $item['Product']['ProductMainImage'] ?>" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <h3 class="name">
                                    <a href="/products/view/<?= $item['Product']['ProductID'] ?>">
                                        <?= $item['Product']['ProductShortName'] ?>
                                    </a>
                                </h3>
                                <div class="price">
                                    <?= BerkaPhp\HelperCurrency::Init($item['Product']['ProductPrice'])->toString()?>
                                </div>
                            </div>
                            <div class="col-xs-1 action">
                                <a href="#" data-remove-item="<?= $item['RefProductID']?>">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
            <!-- /.cart-item -->
            <div class="clearfix"></div>
            <hr>
            <div class="clearfix cart-total">
                <div class="pull-right">
                    <span class="text">Sub Total :</span><span class='price'>
                    <?= BerkaPhp\HelperCurrency::Init($totalPrice)->toString()?>
                </span>
                </div>
                <div class="clearfix"></div>
                <a href="/checkout" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
            <!-- /.cart-total-->
        </li>
    </ul>
</div>