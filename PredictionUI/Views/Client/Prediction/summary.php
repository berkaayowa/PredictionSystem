<?=\BerkaPhp\Helper\Element::Render("Breadcrumb", "Client", array("breadcrumb"=>$breadcrumb))?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="box  box-default breadcrumb-box">
            <div class="box-body">

                <div class="matchDetails hidden">
                    <div class="home">
                        <div class="title"><?=$prediction->HomeTeam->TeamName?></div>
                        <img class="lazy" data-original="<?= !empty($prediction->HomeTeam->TeamFlag) ? $prediction->HomeTeam->TeamFlag : "/Views/Client/Assets/images/icon3.png"?>" alt="arsenal-fc" width="14" height="14">
                    </div>
                </div>

                <label for="" class="label label-info">League Position and Points</label>
                <p>

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
                <label for="" class="label label-info">Last 5 Games Played:</label>
                <p>
                    Team A has showcased impressive form in their last five matches, securing [Number of Wins] victories and [Number of Draws] draws. Meanwhile,
                    Team B has experienced mixed results, with [Number of Wins], [Number of Draws], and [Number of Losses] losses.
                </p>
                <label for="" class="label label-info">Head-to-Head Record:</label>
                <p>
                    Historically, Team A has dominated the head-to-head matchups, winning [Number of Wins] out of the last [Number of Meetings] meetings.
                    Team B, however, has managed to secure [Number of Wins] victories.
                </p>
                <label for="" class="label label-info">Number of Teams in the League</label>
                <p>
                    The league consists of [NumberOfTeamsInTheLeague] teams, making it a competitive environment. Both Team A and Team B face tough competition from other teams vying for success.
                </p>
                <label for="" class="label label-info">Market Odds</label>
                <p>
                    The current market odds favor Team A, with bookmakers offering [Market Odds] for their victory. Team B is considered the underdog, with odds set at [Market Odds].
                </p>

                <label for="" class="label label-info">Prediction:</label>
                <p>
                    Considering the league position, recent form, head-to-head record, and market odds, Team A appears to have the advantage in this matchup.
                    Their higher league position, better recent performance, and historical dominance in head-to-head contests contribute to this prediction.
                    However, soccer is inherently unpredictable, and external factors can influence the outcome. Fans can anticipate an exciting and competitive match between the two teams.
                </p>
            </div>
        </div>
    </div>


    <div class="col-sm-12">

        <div class="box  box-default breadcrumb-box">
            <div class="box-body">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                    <li><a href="#messages" data-toggle="tab">Messages</a></li>
                    <li><a href="#settings" data-toggle="tab">Settings</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="profile">
<!--                        <div class="fixtureTable">-->
                            <table id="dataTable" class="table table-striped predictionTable">
                                <thead class="thead-inverse">
                                <tr class=table-header">
                                    <th class="txt-capitalized  wtp" style="">
                                        home
                                    </th>
                                    <th class="txt-capitalized text-center wtp" style="">
                                        away
                                    </th>
                                    <th class="txt-capitalized text-right wtp underline">
                                        homeTotalPerecentage
                                    </th>
                                    <th class="txt-capitalized text-left wtp underline">

                                        awayTotalPerecentage
                                    </th>
                                    <th class="txt-capitalized text-left wtp underline">
                                        predictionCode
                                    </th>
                                    <th class="txt-capitalized text-left wtp underline">
                                        correctPredictionCode
                                    </th>
                                    <th class="txt-capitalized text-left wtp underline">
                                        Score
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($previousPredictions as $previousPrediction ): ?>
                                    <tr>
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
                    <div class="tab-pane" id="messages">
                        <h4><i class="glyphicon glyphicon-comment"></i></h4>
                        Message ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.
                        <p>Quisque mauris augu.</p>
                    </div>
                    <div class="tab-pane" id="settings">
                        <h4><i class="glyphicon glyphicon-cog"></i></h4>
                        Lorem settings dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.
                        <p>Quisque mauris augue, molestie.</p>
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