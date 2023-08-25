
<?php if(!\BerkaPhp\Helper\Auth::IsUserLogged() && sizeof($predictions) > 0): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="box  box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12 center">
                            <div class="label label-success" role="alert"><?=sizeof($predictions)?></div> Predictions are available, consider signing in to enjoy more free features such daily coupons and more from our platform.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<?php if(true || !$shareCode): ?>
    <div class="row">
        <div class="col-sm-12 ">
            <div class="box box-default ">
                <div class="box-body row ">
                    <div class="col-xm-12 colFrmSearch col-lg-6">
                        <form class="frmSearch row" message="<?=Resource\Label::General("Searching")?>..."  method="GET" id="transactionSearch" ACTION="<?= BerkaPhp\Helper\Html::action('/prediction')?>">
                            <div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8 no-mg-b">
                                <div class="input-group">
                                    <input value="<?=$StartDate?>"  data-date="<?=DATE_SECOND_FORMAT?>" placeholder="<?=Resource\Label::General("StartDate")?>" type="text" class="form-control" name="startDate" id="startDate">
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4 no-mg-b">
                                <button type="submit" class="searchBtn btn btn-primary w-45 pull-left">
                                    <?=Resource\Label::General("Search")?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

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
                                <label class="label label-default author-lbl hide">
                                    <span class="fa fa-heart"></span> <small>Likes</small> <strong><?=$predictionRequest->likes?></strong>
                                </label>
                                <label class="label label-default author-lbl">
                                    <span class="fa fa-eye"></span> <small>Views</small> <strong><?=$predictionRequest->views?></strong>
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
                    <div class="col-sm-12 col-md-12 col-lg-9">
                        <?php if(sizeof($predictions)): ?>
                            <div class="table-responsive fixtureTable">
                                <?php foreach ($predictions as $prediction ): ?>
                                    <?php if(property_exists($prediction, 'PredictionLabel') && strlen($prediction->PredictionLabel) > 0): ?>

                                        <div id="fixtures">
                                            <div data-toggle="collapse" data-target="#cl583" role="button" aria-controls="cl583" data-open="true" class="league league_">

                                                <img class="flag lazy" width="18" height="13" data-original="<?=$prediction->HomeTeam->CountryFlag?>" alt="England">
                                                <div> <?=$prediction->Country?> <a href="/leagues/england/premier-league/583"> <?=$prediction->League?> </a></div>
                                                <div class="counter_m hide">
                                                    <span class="count_matches ">
                                                        <?=property_exists($prediction, 'PredictionLabelFull') ? \Util\Helper::GetPredictionLabel($prediction->HomeTeam->TeamName, $prediction->AwayTeam->TeamName, $prediction->PredictionLabelFull): \Util\Helper::GetPredictionLabel($prediction->HomeTeam->TeamName, $prediction->AwayTeam->TeamName,$prediction->Prediction)?>
                                                    </span>
                                                </div>
                                                <span class="css-c19m5y">
                                                <i class="wf left"></i>
                                              </span>
                                            </div>
                                            <div class="collapse show">
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
                                                        <div class="pRate">
                                                        <?php if(property_exists($prediction, 'Score')  && !empty($prediction->Score->ft_score)) :?>

                                                            <?php if(\Util\Helper::CheckPrediction($prediction->HomeTeam, $prediction->AwayTeam, $prediction->PredictionLabelFull)):?>
                                                                <span class="glyphicon glyphicon-check"></span>
                                                            <?php else:?>
                                                                <span style="color: white" class="glyphicon glyphicon-check"></span>
                                                            <?php endif?>

                                                        <?php else:?>
                                                            <span style="color: white" class="glyphicon glyphicon-check"></span>
                                                        <?php endif?>
                                                        </div>

                                                    </span>
                                                    <div class="wf info">
                                                        <a class="predictionOnDesktop">
                                                            <span class="live_btn" title="Prediction">
                                                                <strong>
                                                                <?=property_exists($prediction, 'PredictionLabelFull') ? \Util\Helper::GetPredictionLabel($prediction->HomeTeam->TeamName, $prediction->AwayTeam->TeamName, $prediction->PredictionLabelFull): \Util\Helper::GetPredictionLabel($prediction->HomeTeam->TeamName, $prediction->AwayTeam->TeamName,$prediction->Prediction)?>
                                                                </strong>
                                                            </span>
                                                        </a>
                                                        <a class="live_stream" data-toggle="collapse" data-target="#panel<?=$prediction->UniqueId?>">
                                                            <span class="live_btn" title="Prediction Details">
                                                                Details
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="prediction-holder predictionOnMobile">
                                            <span>
                                                <?=property_exists($prediction, 'PredictionLabelFull') ? $prediction->PredictionLabelFull : $prediction->Prediction?>
                                            </span>
                                        </div>

                                        <div class="panel-group collapse cpanel-group" id="panel<?=$prediction->UniqueId?>">
                                            <div class="row">
                                                <?php if(true) : ?>
                                                    <div class="col-xs-12 col-sm-6 no-p-r-lg">
                                                        <div class="panel panel-default panel-wrapper" >
                                                            <div class="panel-heading text-left cpanel-header">Prediction Break Down</div>
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <table class="table table-striped predictionTable">
                                                                            <thead class="thead-inverse">
                                                                                <tr class=table-header">
                                                                                    <th class="txt-capitalized  wtp" style="color: #c8c8c8;">
                                                                                        Attributes
                                                                                    </th>
                                                                                    <th class="txt-capitalized text-center wtp" style="color: #c8c8c8;">
                                                                                        Weight %
                                                                                    </th>
                                                                                    <th class="txt-capitalized text-right wtp underline">
                                                                                        <?=$prediction->HomeTeam->TeamName?>
                                                                                    </th>
                                                                                    <th class="txt-capitalized text-left wtp underline">
                                                                                        <?=$prediction->AwayTeam->TeamName?>
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr>
                                                                                <td class="txt-capitalized tSubItem ">
                                                                                    League Points
                                                                                </td>
                                                                                <td class="txt-capitalized tSubItem text-center">
                                                                                    <?=$prediction->PredictionContribution->LeaguePointPercentage?>
                                                                                </td>
                                                                                <td class="txt-capitalized text-right tSubItem ">
                                                                                    <?=number_format((float) $prediction->HomeTeam->LeaguePointPerecentage, 2, '.', '')?>%
                                                                                </td>
                                                                                <td class="txt-capitalized text-left tSubItem">
                                                                                    <?=number_format((float) $prediction->AwayTeam->LeaguePointPerecentage, 2, '.', '')?>%
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="txt-capitalized tSubItem ">
                                                                                    League Position
                                                                                </td>
                                                                                <td class="txt-capitalized tSubItem text-center">
                                                                                    <?=$prediction->PredictionContribution->LeaguePositionPercentage?>
                                                                                </td>
                                                                                <td class="txt-capitalized text-right tSubItem">
                                                                                    <?=number_format((float) $prediction->HomeTeam->LeaguePositionPerecentage, 2, '.', '')?>%
                                                                                </td>
                                                                                <td class="txt-capitalized text-left tSubItem">
                                                                                    <?=number_format((float) $prediction->AwayTeam->LeaguePositionPerecentage, 2, '.', '')?>%
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="txt-capitalized tSubItem">
                                                                                    Head 2 head
                                                                                </td>
                                                                                <td class="txt-capitalized tSubItem text-center">
                                                                                    <?=$prediction->PredictionContribution->HeadtoheadPercentage?>
                                                                                </td>
                                                                                <td class="txt-capitalized text-right tSubItem">
                                                                                    <?=number_format((float) $prediction->HomeTeam->HeadtoheadPerecentage, 2, '.', '')?>%
                                                                                </td>
                                                                                <td class="txt-capitalized text-left tSubItem">
                                                                                    <?=number_format((float) $prediction->AwayTeam->HeadtoheadPerecentage, 2, '.', '')?>%
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="txt-capitalized tSubItem ">
                                                                                    Motivation
                                                                                </td>
                                                                                <td class="txt-capitalized tSubItem text-center">
                                                                                    <?=$prediction->PredictionContribution->LastMatchPercentage?>
                                                                                </td>
                                                                                <td class="txt-capitalized text-right tSubItem">
                                                                                    <?=number_format((float) $prediction->HomeTeam->LastGamesPerecentage, 2, '.', '')?>%
                                                                                </td>
                                                                                <td class="txt-capitalized text-left tSubItem">
                                                                                    <?=number_format((float) $prediction->AwayTeam->LastGamesPerecentage, 2, '.', '')?>%
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="txt-capitalized tSubItem ">
                                                                                    Game Location
                                                                                </td>
                                                                                <td class="txt-capitalized tSubItem text-center">
                                                                                    <?=$prediction->PredictionContribution->AwayHomePercentage?>
                                                                                </td>
                                                                                <td class="txt-capitalized text-right">
                                                                                    <?=number_format((float) $prediction->HomeTeam->AwayOrHomePerecentage, 2, '.', '')?>%
                                                                                </td>
                                                                                <td class="txt-capitalized text-left tSubItem">
                                                                                    <?=number_format((float) $prediction->AwayTeam->AwayOrHomePerecentage, 2, '.', '')?>%
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td class="txt-capitalized tSubItem">
                                                                                    Total %
                                                                                </td>
                                                                                <td class="txt-capitalized tSubItem text-center">
                                                                                    100%
                                                                                </td>
                                                                                <td class="txt-capitalized text-right">
                                                                                    <?=number_format((float) $prediction->HomeTeam->TotalPerecentage, 2, '.', '')?>%
                                                                                </td>
                                                                                <td class="txt-capitalized text-left">
                                                                                    <?=number_format((float) $prediction->AwayTeam->TotalPerecentage, 2, '.', '')?>%
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 no-p-l-lg">
                                                        <div class="panel panel-default panel-wrapper" >
                                                            <div class="panel-heading text-left cpanel-header">Teams & Standing</div>
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <table class="table table-striped predictionTable">
                                                                            <thead class="thead-inverse">
                                                                            <tr class=table-header">
                                                                                <th  class="txt-capitalized  wtp" style="color: #c8c8c8;">
                                                                                    Description
                                                                                </th>
                                                                                <th class="txt-capitalized text-center wtp" style="color: white;">
                                                                                    *******
                                                                                </th>
                                                                                <th class="txt-capitalized text-right wtp underline">
                                                                                    <?=$prediction->HomeTeam->TeamName?>
                                                                                </th>
                                                                                <th class="txt-capitalized text-left wtp underline">
                                                                                    <?=$prediction->AwayTeam->TeamName?>
                                                                                </th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr>
                                                                                <td class="txt-capitalized tSubItem ">
                                                                                    League Points
                                                                                </td>
                                                                                <td class="txt-capitalized tSubItem text-center">

                                                                                </td>
                                                                                <td class="txt-capitalized text-right tSubItem ">
                                                                                    <?=property_exists($prediction->HomeTeam, 'Data') ? $prediction->HomeTeam->Data->LeaguePoints: 'Not Available'?>
                                                                                </td>
                                                                                <td class="txt-capitalized text-left tSubItem">
                                                                                    <?=property_exists($prediction->AwayTeam, 'Data') ? $prediction->AwayTeam->Data->LeaguePoints: 'Not Available'?>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="txt-capitalized tSubItem ">
                                                                                    League Position
                                                                                </td>
                                                                                <td class="txt-capitalized tSubItem text-center">

                                                                                </td>
                                                                                <td class="txt-capitalized text-right tSubItem">
                                                                                    <?=property_exists($prediction->HomeTeam, 'Data') ? $prediction->HomeTeam->Data->LeaguePosition.'th': 'Not Available'?>
                                                                                </td>
                                                                                <td class="txt-capitalized text-left tSubItem">
                                                                                    <?=property_exists($prediction->AwayTeam, 'Data') ? $prediction->AwayTeam->Data->LeaguePosition.'th': 'Not Available'?>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="txt-capitalized tSubItem">
                                                                                    Head 2 Head
                                                                                </td>
                                                                                <td class="txt-capitalized tSubItem text-center">

                                                                                </td>
                                                                                <td class="txt-capitalized text-right tSubItem">
                                                                                    <?php

                                                                                    if(property_exists($prediction->HomeTeam, 'Data')) {

                                                                                        $chars = str_split($prediction->HomeTeam->Data->Headtohead);
                                                                                        $element = "";
                                                                                        foreach ($chars as $char) {
                                                                                            $element = $element . "<label class='recentForm ".$char."'>".$char."</label>";
                                                                                        }

                                                                                        echo "<div class='recentFormWrapper'>".$element."</div>";

                                                                                    } else {
                                                                                        echo 'Not Available';
                                                                                    }

                                                                                    ?>
                                                                                </td>
                                                                                <td class="txt-capitalized text-left tSubItem">
                                                                                    <?php

                                                                                    if(property_exists($prediction->AwayTeam, 'Data')) {

                                                                                        $chars = str_split($prediction->AwayTeam->Data->Headtohead);
                                                                                        $element = "";
                                                                                        foreach ($chars as $char) {
                                                                                            $element = $element . "<label class='recentForm ".$char."'>".$char."</label>";
                                                                                        }

                                                                                        echo "<div class='recentFormWrapper'>".$element."</div>";

                                                                                    } else {
                                                                                        echo 'Not Available';
                                                                                    }

                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="txt-capitalized tSubItem ">
                                                                                    Recent Form
                                                                                </td>
                                                                                <td class="txt-capitalized tSubItem text-center">

                                                                                </td>
                                                                                <td class="txt-capitalized text-right tSubItem">

                                                                                    <?php

                                                                                    if(property_exists($prediction->HomeTeam, 'Data')) {

                                                                                        $chars = str_split($prediction->HomeTeam->Data->RecentForm);
                                                                                        $element = "";
                                                                                        foreach ($chars as $char) {
                                                                                            $element = $element . "<label class='recentForm ".$char."'>".$char."</label>";
                                                                                        }

                                                                                        echo "<div class='recentFormWrapper'>".$element."</div>";

                                                                                    } else {
                                                                                        echo 'Not Available';
                                                                                    }

                                                                                    ?>
                                                                                </td>
                                                                                <td class="txt-capitalized text-left tSubItem">

                                                                                    <?php

                                                                                    if(property_exists($prediction->AwayTeam, 'Data')) {

                                                                                        $chars = str_split($prediction->AwayTeam->Data->RecentForm);
                                                                                        $element = "";
                                                                                        foreach ($chars as $char) {
                                                                                            $element = $element . "<label class='recentForm ".$char."'>".$char."</label>";
                                                                                        }

                                                                                        echo "<div class='recentFormWrapper'>".$element."</div>";

                                                                                    } else {
                                                                                        echo 'Not Available';
                                                                                    }

                                                                                    ?>

                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td class="txt-capitalized tSubItem">
                                                                                    Odds
                                                                                </td>
                                                                                <td class="txt-capitalized tSubItem text-center">

                                                                                </td>
                                                                                <td class="txt-capitalized text-right">
                                                                                    Not Available
                                                                                </td>
                                                                                <td class="txt-capitalized text-left tSubItem">
                                                                                    Not Available
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="txt-capitalized tSubItem ">
                                                                                    Teams In The League
                                                                                </td>
                                                                                <td class="txt-capitalized tSubItem text-center">

                                                                                </td>
                                                                                <td class="txt-capitalized text-right">

                                                                                </td>
                                                                                <td class="txt-capitalized text-left ">
                                                                                    <?=property_exists($prediction->AwayTeam, 'Data') ? $prediction->AwayTeam->Data->NumberOfTeamsInTheLeague: 'Not Available'?>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                <div class="col-xs-12 text-center">
                                                    <a data-toggle="modal" data-target="#mySigninModal">Please sign in to view the prediction break down</a>
                                                </div>
                                                <?php endif ?>
                                            </div>
                                        </div>

                                    <?php endif ?>

                                    <?php $maxPrediction = $maxPrediction - 1; ?>
                                <?php endforeach ?>
                            </div>
                        <?php else: ?>
                            <div class="txt-capitalized text-center">No predictions available</div>
                        <?php endif ?>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-3">

                        <?php if(sizeof($predictions)): ?>
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1836789549483504"
                                crossorigin="anonymous"></script>
                        <!-- Home Vertical Ads Unit -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-1836789549483504"
                             data-ad-slot="8416637603"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>

                        <br>

                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1836789549483504"
                                crossorigin="anonymous"></script>
                        <!-- Home Vertical Ads Unit 2 -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-1836789549483504"
                             data-ad-slot="4272807642"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>

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

        // $('.adsOpen').each(function (e) {
        //
        //     $(this).on('click', function(){
        //
        //         $('.clickable').each(function (e) {
        //
        //             $(this).trigger('click');
        //         });
        //
        //     });
        //
        // })


    })
</script>