
<?php if(!\BerkaPhp\Helper\Auth::IsUserLogged() && sizeof($predictions) > 0): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="box  box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12 center">
                            <div class="label label-success" role="alert"><?=sizeof($predictions)?></div> Predictions are available, consider signing in to view all daily matches predictions and enjoy more other free features such daily coupons and more from our platform.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<?php if(!$shareCode): ?>
    <div class="row">
        <div class="col-sm-12 hide">
            <div class="box  box-default ">
                <div class="box-body row ">
                    <div class=" col-sm-9 colFrmSearch">
                        <form class="frmSearch row" message="<?=Resource\Label::General("Searching")?>..."  method="GET" id="transactionSearch" ACTION="<?= BerkaPhp\Helper\Html::action('/prediction/mobile')?>">
                            <div class="form-group col-sm-3 col-md-3 no-mg-b">
                                <div class="input-group">
                                    <input value="<?=$StartDate?>"  data-date="<?=DATE_SECOND_FORMAT?>" placeholder="<?=Resource\Label::General("StartDate")?>" type="text" class="form-control" name="startDate" id="startDate">
                                    <span class="input-group-addon hide">
                                <span class="fa fa-calendar hide"></span>
                            </span>
                                </div>
                            </div>
                            <div class="form-group col-sm-3 col-md-3 no-mg-b hidden">
                                <div class="input-group ">
                                    <input autocomplete="false" value="<?=$EndDate?>"  data-date="<?=DATE_SECOND_FORMAT?>" placeholder="<?=Resource\Label::General("EndDate")?>" type="text" class="form-control" name="endDate" id="endDate">
                                    <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                                </div>
                            </div>
                            <div class="form-group col-sm-3 col-md-3 no-mg-b">
                                <button type="submit" class="searchBtn btn btn-primary w-45 pull-left">
                                    <?=Resource\Label::General("Search")?>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class=" col-sm-3 right hidden">
                        <a href="<?= BerkaPhp\Helper\Html::action('/message/add')?>" class="btn btn-primary w-45">
                            <i class="fa fa-plus-circle"></i> <?=Resource\Label::General("New Message")?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <?php if($shareCode && $predictionRequest != null && $predictionRequest->IsAny()): ?>
                <div class="box-header btn-brd">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6  col-lg-6">
                            <!--                        <label class="label label-default author-lbl">Author</label>-->
                            <h2 class="hFocusSm">
                                <label class="label label-info author-lbl">Custom Prediction</label>
                                <label class="label label-default author-lbl">Author</label>&nbsp;
                                <label class="label label-default author-lbl">
                                    <span class="fa fa-user"></span> <?=ucfirst($predictionRequest->user->name)?> <?=ucfirst($predictionRequest->user->surname)?>
                                </label>&nbsp;
                                <label class="label label-default author-lbl ratings">
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
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="row">
                                <div class="col-xs-4 col-sm-4 emphasis text-center">
                                    <h2 class="hide"><strong><?=sizeof($predictions)?></strong></h2>
                                    <p class="hide"><span class="fa fa-soccer-ball-o"></span> <small>Games</small></p>
                                </div>
                                <div class="col-xs-4 col-sm-4 emphasis text-center">

                                </div>
                                <div class="col-xs-4 col-sm-4 emphasis text-center">
                                    <h2 class="hFocusSm text-right">
                                        <label class="label label-default author-lbl">
                                            <span class="fa fa-heart"></span> <small>Likes</small> <strong><?=$predictionRequest->likes?></strong>
                                        </label>
                                        &nbsp;
                                        <label class="label label-default author-lbl">
                                            <span class="fa fa-eye"></span> <small>Views</small> <strong><?=$predictionRequest->views?></strong>
                                        </label>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                        </div>
                    </div>
                </div>
            <?php endif ?>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if(true): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered fixtureTable" id="dataTable">
                                    <thead class="thead-inverse">
                                    <tr class=table-header">
                                        <th class="txt-capitalized text-center"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($predictions as $prediction ): ?>
                                        <?php if(property_exists($prediction, 'PredictionLabel') && strlen($prediction->PredictionLabel) > 0): ?>
                                            <tr>
                                                <td class="txt-capitalized text-center  <?=\Util\Helper::GetPredictionToBorder($prediction->Percentage)?>">
                                                    <div id="fixtures">
                                                        <div data-league="583" data-title="Premier League" data-favourite="true" data-toggle="collapse" data-target="#cl583" role="button" aria-controls="cl583" data-open="true" class="league league_">

                                                            <img class="flag" loading="lazy" width="18" height="13" src="/Views/Client/Assets/images/icon2.png" alt="England" onerror="flagError(this)">
                                                            <div> <?=$prediction->Country?> <a href="/leagues/england/premier-league/583"> <?=$prediction->League?> </a></div>
<!--                                                            <a data-flag="" href="javascript:void(0);" class="fav-star add-to-fav">-->
<!--                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star star">-->
<!--                                                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>-->
<!--                                                                </svg>-->
<!--                                                            </a>-->
                                                            <div class="counter_m">
                                                                <span class="count_matches"></span>
                                                                <span class="count_live inplay"></span>
                                                            </div>
                                                            <span class="css-c19m5y">
                                                            <i class="wf left"></i>
                                                          </span>
                                                        </div>
                                                        <div class="collapse show" id="cl583">
                                                            <div data-datetime="2023-08-21 19:00:00" data-match="1668978" data-status-id="0" class="match i">
                                                                <div class="tm">
                                                                    <span class="time" data-time="<?= date('h:i A', strtotime($prediction->Date))?>"><?= date('h:i A', strtotime($prediction->Date))?></span>
                                                                </div>
                                                                <div class="mteams">
                                                                    <div data-home-id="9" class="home ">
                                                                        <div class="events"></div> <?=$prediction->HomeTeam->TeamName?> <img class="lazy" data-original="<?= !empty($prediction->HomeTeam->TeamFlag) ? $prediction->HomeTeam->TeamFlag : "/Views/Client/Assets/images/icon2.png"?>" width="14" height="14">
                                                                    </div>
                                                                    <div data-away-id="18" class="away ">
                                                                        <img class="lazy" data-original="<?= !empty($prediction->AwayTeam->TeamFlag) ? $prediction->AwayTeam->TeamFlag : "/Views/Client/Assets/images/icon2.png"?>" alt="arsenal-fc" width="14" height="14"><?=$prediction->AwayTeam->TeamName?> <div class="events"></div>
                                                                    </div>
                                                                </div>

                                                                <?php if(property_exists($prediction, 'Score')  && !empty($prediction->Score->ft_score)) :?>

                                                                    <div class="score">
                                                                        <span data-home-score="" class=""><?=$prediction->HomeTeam->Score?></span>
                                                                        <span data-away-score="" class=""><?=$prediction->AwayTeam->Score?></span>
                                                                    </div>

                                                                <?php else:?>
                                                                    <div class="score">
                                                                        <span data-home-score="" class=""></span>
                                                                        <span data-away-score="" class=""></span>
                                                                    </div>
                                                                <?php endif?>

                                                                <span class="second_text status_info">

                                                                    <?php if(property_exists($prediction, 'Score')  && !empty($prediction->Score->ft_score)) :?>

                                                                        <?php if(\Util\Helper::CheckPrediction($prediction->HomeTeam, $prediction->AwayTeam, $prediction->PredictionLabelFull)):?>
                                                                            <div class="pRate">
                                                                                <span class="glyphicon glyphicon-check"></span>
                                                                            </div>
                                                                        <?php endif?>
                                                                    <?php endif?>

                                                                </span>
                                                                <div class="wf info">
                                                                    <a>
                                                                        <span class="live_btn" title="Live"><?=property_exists($prediction, 'PredictionLabelFull') ? \Util\Helper::GetPredictionLabel($prediction->HomeTeam->TeamName, $prediction->AwayTeam->TeamName, $prediction->PredictionLabelFull): \Util\Helper::GetPredictionLabel($prediction->HomeTeam->TeamName, $prediction->AwayTeam->TeamName,$prediction->Prediction)?></span>
                                                                    </a>
                                                                    <a class="live_stream" href="https://soccerprediction.co.za" target="_blank">
                                                                        <span class="live_btn" title="Live">
                                                                            Prediction Details
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                                <a class="opmatch" href="/match/crystal-palace-arsenal-fc/1668978"></a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>

                                            </tr>
                                        <?php endif ?>

                                        <?php $maxPrediction = $maxPrediction - 1; ?>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
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

        setTimeout(
            function()
            {
                var colFrmSearch = $(".colFrmSearch").clone().html();
                $("#dataTable_filter").append(colFrmSearch);

                $('[data-date]').datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy'
                });

                $('.paginate_button').each(function (e) {

                    $(this).on('click', function(){
                        console.log($(this).text());
                        $("img.lazy").lazyload({effect : "fadeIn"});
                    });

                })

            }, 600);

        $("img.lazy").lazyload({effect : "fadeIn"});


    })
</script>