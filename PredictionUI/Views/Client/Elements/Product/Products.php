<?php if(sizeof($model['products']) > 0) :?>
    <div class="clearfix filters-container m-t-0">
        <div class="row">
            <div class="col col-sm-6 col-md-2">
                <div class="filter-tabs">
                    <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                        <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a> </li>
                        <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                    </ul>
                </div>
                <!-- /.filter-tabs -->
            </div>
            <!-- /.col -->
            <div class="col col-sm-12 col-md-6">
                <div class="col col-sm-3 col-md-6 no-padding">
<!--                    <div class="lbl-cnt"> <span class="lbl">Sort by</span>-->
<!--                        <div class="fld inline">-->
<!--                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">-->
<!--                                <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> Position <span class="caret"></span> </button>-->
<!--                                <ul role="menu" class="dropdown-menu">-->
<!--                                    <li role="presentation"><a href="#">Price:Lowest first</a></li>-->
<!--                                    <li role="presentation"><a href="#">Price:HIghest first</a></li>-->
<!--                                    <li role="presentation"><a href="#">Product Name:A to Z</a></li>-->
<!--                                </ul>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <!-- /.lbl-cnt -->
                </div>
                <!-- /.col -->
                <div class="col col-sm-3 col-md-6 no-padding">
<!--                    <div class="lbl-cnt"> <span class="lbl">Show</span>-->
<!--                        <div class="fld inline">-->
<!--                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">-->
<!--                                <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1 <span class="caret"></span> </button>-->
<!--                                <ul role="menu" class="dropdown-menu">-->
<!--                                    <li role="presentation"><a href="#">1</a></li>-->
<!--                                    <li role="presentation"><a href="#">2</a></li>-->
<!--                                    <li role="presentation"><a href="#">3</a></li>-->
<!--                                </ul>-->
<!--                            </div>-->
<!--                        </div>-->
                        <!-- /.fld -->
<!--                    </div>-->
                    <!-- /.lbl-cnt -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.col -->
            <div class="col col-sm-6 col-md-4 text-right">
                <div class="pagination-container">
                    <ul class="list-inline list-unstyled">
<!--                        <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>-->
                        <li>&nbsp;</li>
<!--                        <li class="active"><a href="#">2</a></li>-->
<!--                        <li><a href="#">3</a></li>-->
<!--                        <li><a href="#">4</a></li>-->
<!--                        <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>-->
                    </ul>
                    <!-- /.list-inline -->
                </div>
                <!-- /.pagination-container --> </div>
            <!-- /.col -->
        </div>
    </div>
    <div class="search-result-container ">
        <div id="myTabContent" class="tab-content category-list">
            <div class="tab-pane active " id="grid-container">
                <div class="category-product">
                    <div class="row">
                        <?php foreach($model['products'] as $product) :?>
                            <div class="col-sm-6 col-md-4 wow fadeInUp">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="/products/view/<?= $product['ProductID']?>/?<?=$product['ProductShortName']?>">
                                                    <img src="<?=$product["ProductMainImage"] != null ? $product["ProductMainImage"] : '/Views/Client/Assets/images/products/p5.jpg' ?>">
                                                </a>
                                            </div>
                                            <?php if($product['IsBrandNew'] == \BerkaPhp\Helper\Check::True()) :?>
                                                <div class="tag new"><span>new</span></div>
                                            <?php endif ?>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-center">
                                            <h3 class="name">
                                                <a href="/products/view/<?= $product['ProductID']?>/<?=$product['ProductShortName']?>" data-product-name="<?= $product['ProductID']?>">
                                                    <?=\BerkaPhp\Helpertr::limitChar($product['ProductShortName'],25)?>
                                                </a>
                                            </h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>
                                            <div class="product-price">
                                                <span class="price"><?= BerkaPhp\HelperCurrency::Init($product['ProductPrice'])->toString()?></span>
                                                <span class="price-before-discount"><?= BerkaPhp\HelperCurrency::Init($product['ProductPrice'])->toString()?></span>
                                            </div>
                                            <div class="add-button">
                                                <a class="add-to-cart" data-add-to-cart="<?= $product['ProductID']?>" title="Add to cart">
                                                    <i class="fa fa-shopping-cart"></i> Add to cart
                                                </a>
                                            </div>
                                        </div>
                                        <!-- /.product-info -->
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane "  id="list-container">
                <div class="category-product">
                    <div class="category-product-inner wow fadeInUp">
                        <div class="products">
                            <div class="product-list product">
                                <?php foreach($model['products'] as $product) :?>
                                    <div class="row product-list-row">
                                        <div class="col col-sm-4 col-lg-4">
                                            <div class="product-image">
                                                <div class="image">
                                                    <img src="<?=$product["ProductMainImage"] != null ? $product["ProductMainImage"] : '/Views/Client/Assets/images/products/p5.jpg' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-sm-8 col-lg-8">
                                            <div class="product-info">
                                                <h3 class="name">
                                                    <a href="/products/view/<?= $product['ProductID']?>/?<?=$product['ProductShortName']?>"  data-product-name="<?= $product['ProductID']?>">
                                                        <?= $product['ProductFullName']?>
                                                    </a>
                                                </h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="product-price">
                                                <span class="price">
                                                    <?= BerkaPhp\HelperCurrency::Init($product['ProductPrice'])->toString()?>
                                                </span>
                                                <span class="price-before-discount">
                                                    <?= BerkaPhp\HelperCurrency::Init($product['ProductPrice'])->toString()?>
                                                </span>
                                                </div>
                                                <div class="description m-t-10">
                                                    <?= $product['ProductDescription']?>
                                                </div>
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button class="btn btn-primary cart-btn" type="button" data-add-to-cart="<?= $product['ProductID']?>">
                                                                    <i class="fa fa-shopping-cart"></i>
                                                                    Add to cart
                                                                </button>
                                                            </li>
                                                            <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                            <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                                <!-- /.product-list-row -->
                                <div class="tag new"><span>new</span></div>
                            </div>
                            <!-- /.product-list -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.tab-content -->
        <div class="clearfix filters-container">
            <div class="text-right">
                <div class="pagination-container">
                    <ul class="list-inline list-unstyled">
<!--                        <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>-->
                        <li>&nbsp;</li>
<!--                        <li class="active"><a href="#">2</a></li>-->
<!--                        <li><a href="#">3</a></li>-->
<!--                        <li><a href="#">4</a></li>-->
<!--                        <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php endif?>