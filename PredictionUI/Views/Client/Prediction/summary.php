<?=\BerkaPhp\Helper\Element::Render("Breadcrumb", "Client", array("breadcrumb"=>$breadcrumb))?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="box  box-default breadcrumb-box">
            <div class="box-body">

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
                                                        <?=property_exists($prediction->HomeTeam->Data, 'Odd')  && !empty($prediction->HomeTeam->Data->Odd) ? $prediction->HomeTeam->Data->Odd : ' Not Available'?>
                                                    </td>
                                                    <td class="txt-capitalized text-left tSubItem">
                                                        <?=property_exists($prediction->AwayTeam->Data, 'Odd') && !empty($prediction->AwayTeam->Data->Odd) ? $prediction->AwayTeam->Data->Odd : ' Not Available'?>
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

                <div class="matchDetails hidden">
                    <div class="home">
                        <div class="title"><?=$prediction->HomeTeam->TeamName?></div>
                        <img class="lazy" data-original="<?= !empty($prediction->HomeTeam->TeamFlag) ? $prediction->HomeTeam->TeamFlag : "/Views/Client/Assets/images/icon3.png"?>" alt="arsenal-fc" width="14" height="14">
                    </div>
                </div>

                <br>
                <p class="hidden">
                    <?php if($prediction->HomeTeam->LeaguePositionPerecentage > $prediction->AwayTeam->LeaguePositionPerecentage) :?>

                        <b><?=$prediction->HomeTeam->TeamName?></b> is currently positioned higher in the league, sitting at <b><?=$prediction->HomeTeam->Data->LeaguePosition?>th</b> with <b><?=$prediction->HomeTeam->Data->LeaguePoints?> points.</b>
                    <?php else : ?>
                        <b><?=$prediction->AwayTeam->TeamName?></b> is currently positioned higher in the league, sitting at <b><?=$prediction->AwayTeam->Data->LeaguePosition?>th</b> with <b><?=$prediction->AwayTeam->Data->LeaguePoints?> points.</b>
                    <?php endif ?>

                    <?php if($prediction->HomeTeam->LeaguePositionPerecentage < $prediction->AwayTeam->LeaguePositionPerecentage) :?>
                        <b><?=$prediction->HomeTeam->TeamName?></b>  on the other hand, is <b><?=$prediction->HomeTeam->Data->LeaguePosition?>th</b> with <b><?=$prediction->HomeTeam->Data->LeaguePoints?> points.</b>
                    <?php else : ?>
                        <b><?=$prediction->AwayTeam->TeamName?></b>  on the other hand, is <b><?=$prediction->AwayTeam->Data->LeaguePosition?>th</b> with <b><?=$prediction->AwayTeam->Data->LeaguePoints?> points</b>.
                    <?php endif ?>

                    and the league consists of  <b><?=$prediction->AwayTeam->Data->NumberOfTeamsInTheLeague?></b> teams,

                </p>

                <div for="" class="text-center">
                    <h3><?=property_exists($prediction, 'PredictionLabelFull') ? $prediction->PredictionLabelFull : $prediction->Prediction?></h3>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-12">

        <div class="box  box-default breadcrumb-box">
            <div class="box-body">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#profile" data-toggle="tab">Previous Predictions</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="profile">
<!--                        <div class="fixtureTable">-->
                            <table id="dataTable" class="table table-striped predictionTable">
                                <thead class="thead-inverse">
                                <tr class=table-header">
                                    <th class="txt-capitalized  wtp" style="">
                                        Country
                                    </th>
                                    <th class="txt-capitalized  wtp" style="">
                                        League
                                    </th>
                                    <th class="txt-capitalized  wtp" style="">
                                        home
                                    </th>
                                    <th class="txt-capitalized text-center wtp" style="">
                                        away
                                    </th>
                                    <th class="txt-capitalized text-right wtp underline">
                                        home %
                                    </th>
                                    <th class="txt-capitalized text-left wtp underline">
                                        Away %
                                    </th>
                                    <th class="txt-capitalized text-left wtp underline">
                                        Prediction
                                    </th>
                                    <th class="txt-capitalized text-left wtp underline">
                                        Result
                                    </th>
                                    <th class="txt-capitalized text-left wtp underline">
                                        Score
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($previousPredictions as $previousPrediction ): ?>
                                    <tr>
                                        <td><?=$previousPrediction->country?></td>
                                        <td><?=$previousPrediction->league?></td>
                                        <td><?=$previousPrediction->home?></td>
                                        <td><?=$previousPrediction->away?></td>
                                        <td><?=$previousPrediction->homeTotalPerecentage?></td>
                                        <td><?=$previousPrediction->awayTotalPerecentage?></td>
                                        <td><?=$previousPrediction->predictionCode?></td>
                                        <td><?=$previousPrediction->correctPredictionCode?></td>
                                        <td><?=$previousPrediction->homeScore?> - <?=$previousPrediction->awayScore?></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
<!--                        </div>-->
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