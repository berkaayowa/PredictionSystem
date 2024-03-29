<?php

$shareCode = array_key_exists('shareCode', $model) ? $model['shareCode'] : false;
$predictionRequest = array_key_exists('predictionRequest', $model) ? $model['predictionRequest'] : null;
$couponGenerated = $model['couponGenerated'];
$maxPrediction = array_key_exists('maxPrediction', $model) ? $model['maxPrediction'] : 10;
$count = 1;
?>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-default">
            <?php if($shareCode && $predictionRequest != null && $predictionRequest->IsAny()): ?>
                <div class="box-header btn-brd">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <h2 class="hFocusSm">
                                <label class="label label-info author-lbl hide">Custom Prediction</label>
                                <label class="label label-default author-lbl hide">Author</label>
                                <label class="label label-default author-lbl">
                                    <span class="fa fa-user"></span> <?=ucfirst($predictionRequest->user->name)?> <?=ucfirst($predictionRequest->user->surname)?>
                                </label>
                                <label class="label label-default author-lbl ratings hide">
                                    Ratings
                                    <a href="#">
                                        <span class="fa fa-star"></span>
                                    </a>
                                    <a href="#">
                                        <span class="fa fa-star"></span>
                                    </a>
                                    <a href="#">
                                        <span class="fa fa-star-o"></span>
                                    </a>
                                    <a href="#">
                                        <span class="fa fa-star-o"></span>
                                    </a>
                                    <a href="#">
                                        <span class="fa fa-star-o"></span>
                                    </a>

                                </label>
                            </h2>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <h2 class="hFocusSm text-right">
                                <label class="label label-default author-lbl hide hide">
                                    <span class="fa fa-heart"></span> <small>Likes</small> <strong><?=$predictionRequest->likes?></strong>
                                </label>
                                <label class="label label-default author-lbl">
                                    <span class="fa fa-eye"></span> <strong><?= date('d-m-Y', strtotime($predictionRequest->requestedDate))?></strong>
                                </label>
                            </h2>
                        </div>
                        <div class="col-xs-12 hide">
                            <br>
                            <h2 class="hFocusSm">
                                <label class="label label-default author-lbl">
                                    <span class="fa fa-clock-o"></span> <small>Likes</small> <strong>hhh</strong>
                                </label>
                            </h2>
                        </div>
                    </div>
                </div>
            <?php endif ?>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <?php if(sizeof($couponGenerated)): ?>
                            <div class="table-responsive fixtureTable">

                                <?php foreach ($couponGenerated as $predictions ): ?>
                                    <div class="coupon">
                                        <span>Coupon Number #<?=$count?></span>
                                    </div>
                                    <?php foreach ($predictions as $prediction ): ?>
                                        <?php if(true): ?>
                                            <?php \BerkaPhp\Helper\Element::Render("Prediction", "Client", array('prediction'=>$prediction))?>
                                            <?php if($maxPrediction == 0 && !(\BerkaPhp\Helper\Auth::IsUserLogged() && BerkaPhp\Helper\Auth::GetActiveUser()->role->code == 'ADM')): ?>
                                                <div class="adsHolder">
                                                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1836789549483504"
                                                            crossorigin="anonymous"></script>
                                                    <ins class="adsbygoogle"
                                                         style="display:block; text-align:center;"
                                                         data-ad-layout="in-article"
                                                         data-ad-format="fluid"
                                                         data-ad-client="ca-pub-1836789549483504"
                                                         data-ad-slot="1472805361"></ins>
                                                    <script>
                                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                                    </script>
                                                </div>
                                                <?php $maxPrediction = 10; ?>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <?php $maxPrediction = $maxPrediction - 1; ?>
                                    <?php endforeach ?>

                                    <div class="coupon">
                                        <span>End</span>
                                    </div>
                                <?php $count = $count + 1?>
                                <?php endforeach ?>
                            </div>
                        <?php else: ?>
                            <div class="txt-capitalized text-center">No predictions available</div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function (e) {
        $("img.lazy").lazyload({effect : "fadeIn"});
    })
</script>