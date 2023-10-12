
<?php

 $prediction = $model['prediction'];

?>

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
                    <div class="events"></div> <?=$prediction->HomeTeam->TeamName?> <img class="lazy" data-original="<?= !empty($prediction->HomeTeam->TeamFlag) ? $prediction->HomeTeam->TeamFlag : "/Views/Client/Assets/images/icon3.png"?>" width="14" height="14">
                </div>
                <div data-away-id="18" class="away ">
                    <img class="lazy" data-original="<?= !empty($prediction->AwayTeam->TeamFlag) ? $prediction->AwayTeam->TeamFlag : "/Views/Client/Assets/images/icon3.png"?>" alt="arsenal-fc" width="14" height="14"><?=$prediction->AwayTeam->TeamName?> <div class="events"></div>
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

                    <?php if(\Util\Helper::CheckPrediction($prediction->HomeTeam, $prediction->AwayTeam, property_exists($prediction, 'PredictionLabelFull') ? $prediction->PredictionLabelFull : $prediction->Prediction)):?>
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
                    <span class="live_btn" title="Prediction" data-toggle="collapse" data-target="#panel<?=$prediction->UniqueId?>" data-details="<?=$prediction->UniqueId?>">
                        <strong>
                        <?=property_exists($prediction, 'PredictionLabelFull') ? $prediction->PredictionLabelFull : $prediction->Prediction?>
                        </strong>
                    </span>
                </a>
                <a class="live_stream" data-toggle="collapse" data-target="#panel<?=$prediction->UniqueId?>" data-details="<?=$prediction->UniqueId?>">
                    <span class="live_btn" title="Prediction Details">
                        Details
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="prediction-holder predictionOnMobile" data-toggle="collapse" data-target="#panel<?=$prediction->UniqueId?>" data-details="<?=$prediction->UniqueId?>">
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

            <?php if(true) : ?>
                <div class="col-xs-12" id="cmt<?=$prediction->UniqueId?>">
                    <div class="cmt text-right" target="#cmt<?=$prediction->UniqueId?>" data-post-action="/prediction/comments/<?=$prediction->UniqueId?>">
                        <?php if(\Util\Helper::CountComments($prediction->UniqueId) > 0) : ?>
                            <a><?=\Util\Helper::CountComments($prediction->UniqueId)?> <i class="fa fa-comment"></i> Comment/s</a>
                        <?php else : ?>
                            <a><i class="fa fa-comment"></i> Comment</a>
                        <?php endif ?>
                    </div>
                </div>

            <?php endif ?>

        <?php else: ?>
            <div class="col-xs-12 text-center">
                <a data-toggle="modal" data-target="#mySigninModal">Please sign in to view the prediction break down</a>
            </div>
        <?php endif ?>
    </div>
</div>