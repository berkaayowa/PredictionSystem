<?php $count = 1;?>

<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default ">
            <div class="box-body ">
                <h3 class="headerFocus">Prediction Coupons</h3>
                <p class="pSubHeaderx">
                    You can always update/change your filters below, it helps to refine your selections for creating game coupons and .
                    It offers several criteria to customize the predictions based on user preferences. <a href="/pages/predictionfilters" style="text-decoration: underline">Click here to read more </a>
                </p>
                <?= $request->IsAny() ? '<hr><h4 class="headerFocusx">Request: <span class="label label-info">' . $request->description . '</span> Prediction Template: <span class="label label-info">' . $request->configuration->name .'</span></h4>': ''?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default ">
            <form class="frmSearch" message="<?=Resource\Label::General("Requesting")?>..."  method="get" id="requestx"  action="<?= BerkaPhp\Helper\Html::action('/coupons/index/'.$request->id)?>">

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label class="label label-default" for="firstName">Number Of Games Per Coupon</label>
                                <input value="<?=$numberOfGamesPerCoupon?>" required autocomplete="off" type="number" class="form-control" name="numberOfGamesPerCoupon" id="numberOfGamesPerCoupon">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label class="label label-default" for="firstName">Number Of Games Per League</label>
                                <input value="<?=$numberOfGamesPerLeague?>" required autocomplete="off" type="number" class="form-control" name="numberOfGamesPerLeague" id="numberOfGamesPerLeague">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label class="label label-default" for="firstName">League Points % >=</label>
                                <input value="<?=$leaguePointPercentageOverOREqual?>" required autocomplete="off" type="number" class="form-control" name="leaguePointPercentageOverOREqual" id="leaguePointPercentageOverOREqual">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label class="label label-default" for="firstName">Game Motivation % >=</label>
                                <input value="<?=$gameMotivation?>" required autocomplete="off" type="number" class="form-control" name="gameMotivation" id="gameMotivation">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label class="label label-default" for="firstName">Head 2 Head % >=</label>
                                <input value="<?=$h2hPercentage?>" required autocomplete="off" type="number" class="form-control" name="h2hPercentage" id="h2hPercentage">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label class="label label-default" for="firstName">Game Location</label>
                                <?= Util\Helper::select('gameLocation', [['id'=>'0','label'=>'Default'],['id'=>'1','label'=>'Home'],['id'=>'2','label'=>'Away']], ['selected'=>$gameLocation, 'value'=>'id', 'class'=>'form-control', 'data-dropdrown'=>true, 'required'=>true], function($data) {
                                    return $data['label'];
                                }) ?>
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-sm-10 ">
                            <div class="form-label-groupx">
                                <label class="label label-default" for="firstName">Leagues</label>
                                <?= Util\Helper::select('leagueId[]', $leagueIds, ['selected'=> $selectedLeague,'value'=>'value', 'class'=>'form-control h150px', 'multiple'=>'multiple', 'data-static-dropdown'=>true], function($data) {
                                    return $data['text'];
                                }) ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label class="label label-default" for="firstName">Allow Duplicated Game</label>
                                <?= Util\Helper::select('allowedDuplicateGame', [['id'=>'1','label'=>'Yes'],['id'=>'2','label'=>'No']], ['selected'=> $allowedDuplicateGame === true ? '1' : '2','value'=>'id', 'class'=>'form-control', 'data-dropdrown'=>true, 'required'=>true], function($data) {
                                    return $data['label'];
                                }) ?>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <button type="submit" class="btn btn-primary btn-themed">
                                            <?=Resource\Label::General("Create Coupons")?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-header btn-brd hide">


            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <?php if(sizeof($predictions)): ?>
                            <div class="table-responsive fixtureTable">
                                <?php foreach ($predictions as $prediction ): ?>
                                    <?php if(true): ?>

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


                                        <?php if($maxPrediction == 0): ?>
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

    function loadImage() {

        $('[data-img]').each(function (e){

            var url = $(this).attr('data-img');
            $(this).attr('src', url);
            // console.log(url);

        });

    }

    $(document).ready(function (e) {
        $('#coupon').DataTable({
            "order": false,
            paging: false
        });

        $("img.lazy").lazyload({effect : "fadeIn"});
    })
</script>
