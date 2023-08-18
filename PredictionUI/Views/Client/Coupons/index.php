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
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered fixtureTable" id="coupon">
                                <thead class="thead-inverse">
                                <tr class=table-header">
                                    <th class="txt-capitalized text-center hideOnMobile">Date</th>
                                    <th class="txt-capitalized text-center hideOnMobile">Country</th>
                                    <th class="txt-capitalized text-center hideOnMobile">League</th>
                                    <th class="txt-capitalized text-center">Home Team</th>
                                    <th class="txt-capitalized text-center" style="width: 100px">vs</th>
                                    <th class="txt-capitalized text-center">Away Team</th>
                                    <th class="txt-capitalized text-center hideOnMobile">Prediction</th>
                                    <th class="txt-capitalized text-center hide">% Difference</th>
                                    <th class="txt-capitalized text-center hideOnMobile">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($couponGenerated as $predictions ): ?>

                                        <tr>
                                            <td class="divider">Coupon #<?=$count?></td>
                                            <td class="divider"></td>
                                            <td class="divider"></td>
                                            <td class="divider"></td>
                                            <td class="divider"></td>
                                            <td class="divider"></td>
                                            <td class="divider"></td>
                                            <td class="divider hide"></td>
                                            <td class="divider"></td>
                                        </tr>

                                        <?php foreach ($predictions as $prediction ): ?>
                                            <?php if(property_exists($prediction, 'PredictionLabel') && strlen($prediction->PredictionLabel) > 0): ?>
                                            <tr>
                                                <td class="txt-capitalized text-center hideOnMobile  <?=\Util\Helper::GetPredictionToBorder($prediction->Percentage)?>">
                                                    <lable class="width_100px"><?= date('d/m/Y', strtotime($prediction->Date))?></lable>
                                                </td>

                                                <td class="txt-capitalized text-center hideOnMobile <?=\Util\Helper::GetPredictionToBorder($prediction->Percentage)?>"><?=$prediction->Country?></td>
                                                <td class="txt-capitalized text-center hideOnMobile <?=\Util\Helper::GetPredictionToBorder($prediction->Percentage)?>">
                                                    <?=$prediction->League?>
                                                </td>

                                                <td title="<?=$prediction->HomeTeam->TeamName?>" class="txt-capitalized text-center bold <?=\Util\Helper::GetPredictionToBorder($prediction->Percentage)?>">
                                                    <?=\Util\Helper::DisplayLabel(10, $prediction->HomeTeam->TeamName)?>
                                                </td>

                                                <td class="txt-capitalized text-center <?=\Util\Helper::GetPredictionToBorder($prediction->Percentage)?>">
                                                    <div class="vsHolder">
                                                        <div class="score">
                                                            <div class="flag">
                                                                <img src="<?= !empty($prediction->HomeTeam->TeamFlag) ? $prediction->HomeTeam->TeamFlag : "/Views/Client/Assets/images/icon2.png"?>" alt="">
                                                            </div>
                                                            <div class="scoreDetail">
                                                                <?php if(property_exists($prediction, 'Score')  && !empty($prediction->Score->ft_score)) :?>

                                                                    <label for=""><?= $prediction->Score->ft_score?></label>

                                                                    <?php if(\Util\Helper::CheckPrediction($prediction->HomeTeam, $prediction->AwayTeam, $prediction->PredictionLabelFull)):?>
                                                                        <div class="pRate">
                                                                            <span class="glyphicon glyphicon-check"></span>
                                                                        </div>
                                                                    <?php endif?>

                                                                <?php else:?>
                                                                    <label for=""><?= date('h:i A', strtotime($prediction->Date))?></label>
                                                                <?php endif?>
                                                            </div>

                                                            <div class="flag">
                                                                <img src="<?= !empty($prediction->AwayTeam->TeamFlag) ? $prediction->AwayTeam->TeamFlag : "/Views/Client/Assets/images/icon2.png"?>" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="predictionHolder showOnMobile <?=\Util\Helper::GetPredictionBg($prediction->Percentage)?>">
                                                            <label class="league"><?=\Util\Helper::DisplayLabel(25,$prediction->Country. ' / '. $prediction->League)?></label>
                                                            <label class=""><?=$prediction->PredictionLabelFull?></label>
                                                            <button type="button" class="btn btn-default btn " data-toggle="modal" data-target="#myModal<?=$prediction->UniqueId?>">Prediction Details</button>
                                                        </div>
                                                    </div>

                                                    <?php if($maxPrediction > 0) : ?>
                                                        <div id="myModal<?=$count?><?=$prediction->UniqueId?>" class="modal" role="dialog">
                                                            <div class="modal-dialog">
                                                                <!-- Modal content-->
                                                                <div class="modal-content <?=\Util\Helper::GetPredictionToBorder($prediction->Percentage)?>">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title"> <?=property_exists($prediction, 'PredictionLabelFull') ? $prediction->PredictionLabelFull : $prediction->Prediction?></h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <table class="table table-striped">
                                                                                    <thead class="thead-inverse">
                                                                                    <tr class=table-header">
                                                                                        <th class="txt-capitalized text-center w-20" style="color: #c8c8c8;">
                                                                                            Attributes
                                                                                        </th>
                                                                                        <th class="txt-capitalized text-center w-20" style="color: #c8c8c8;">
                                                                                            Weight %
                                                                                        </th>
                                                                                        <th class="txt-capitalized text-right w-20 underline">
                                                                                            <?=$prediction->HomeTeam->TeamName?>
                                                                                        </th>
                                                                                        <th class="txt-capitalized text-left w-20 underline">
                                                                                            <?=$prediction->AwayTeam->TeamName?>
                                                                                        </th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td class="txt-capitalized tSubItem">
                                                                                            League Points
                                                                                        </td>
                                                                                        <td class="txt-capitalized tSubItem">
                                                                                            <?=$prediction->PredictionContribution->LeaguePointPercentage?>
                                                                                        </td>
                                                                                        <td class="txt-capitalized text-right tSubItem">
                                                                                            <?=$prediction->HomeTeam->LeaguePointPerecentage?>%
                                                                                        </td>
                                                                                        <td class="txt-capitalized text-left tSubItem">
                                                                                            <?=$prediction->AwayTeam->LeaguePointPerecentage?>%
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="txt-capitalized tSubItem">
                                                                                            League Position
                                                                                        </td>
                                                                                        <td class="txt-capitalized tSubItem">
                                                                                            <?=$prediction->PredictionContribution->LeaguePositionPercentage?>
                                                                                        </td>
                                                                                        <td class="txt-capitalized text-right tSubItem">
                                                                                            <?=$prediction->HomeTeam->LeaguePositionPerecentage?>%
                                                                                        </td>
                                                                                        <td class="txt-capitalized text-left tSubItem">
                                                                                            <?=$prediction->AwayTeam->LeaguePositionPerecentage?>%
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="txt-capitalized tSubItem">
                                                                                            Head 2 head
                                                                                        </td>
                                                                                        <td class="txt-capitalized tSubItem">
                                                                                            <?=$prediction->PredictionContribution->HeadtoheadPercentage?>
                                                                                        </td>
                                                                                        <td class="txt-capitalized text-right tSubItem">
                                                                                            <?=$prediction->HomeTeam->HeadtoheadPerecentage?>%
                                                                                        </td>
                                                                                        <td class="txt-capitalized text-left tSubItem">
                                                                                            <?=$prediction->AwayTeam->HeadtoheadPerecentage?>%
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="txt-capitalized tSubItem">
                                                                                            Motivation
                                                                                        </td>
                                                                                        <td class="txt-capitalized tSubItem">
                                                                                            <?=$prediction->PredictionContribution->LastMatchPercentage?>
                                                                                        </td>
                                                                                        <td class="txt-capitalized text-right tSubItem">
                                                                                            <?=$prediction->HomeTeam->LastGamesPerecentage?>%
                                                                                        </td>
                                                                                        <td class="txt-capitalized text-left tSubItem">
                                                                                            <?=$prediction->AwayTeam->LastGamesPerecentage?>%
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="txt-capitalized tSubItem">
                                                                                            Game Location
                                                                                        </td>
                                                                                        <td class="txt-capitalized tSubItem">
                                                                                            <?=$prediction->PredictionContribution->AwayHomePercentage?>
                                                                                        </td>
                                                                                        <td class="txt-capitalized text-right">
                                                                                            <?=$prediction->HomeTeam->AwayOrHomePerecentage?>%
                                                                                        </td>
                                                                                        <td class="txt-capitalized text-left tSubItem">
                                                                                            <?=$prediction->AwayTeam->AwayOrHomePerecentage?>%
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <td class="txt-capitalized tSubItem">
                                                                                            Total %
                                                                                        </td>
                                                                                        <td class="txt-capitalized tSubItem">
                                                                                            100%
                                                                                        </td>
                                                                                        <td class="txt-capitalized text-right">
                                                                                            <?=$prediction->HomeTeam->TotalPerecentage?>%
                                                                                        </td>
                                                                                        <td class="txt-capitalized text-left tSubItem">
                                                                                            <?=$prediction->AwayTeam->TotalPerecentage?>%
                                                                                        </td>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    <?php endif ?>
                                                </td>
                                                <td title="<?=$prediction->AwayTeam->TeamName?>" class="txt-capitalized text-center bold <?=\Util\Helper::GetPredictionToBorder($prediction->Percentage)?>">
                                                    <?=\Util\Helper::DisplayLabel(10,$prediction->AwayTeam->TeamName)?>
                                                </td>

                                                <td class="txt-capitalized text-center hideOnMobile <?=\Util\Helper::GetPredictionToBorder($prediction->Percentage)?>">
                                                    <div class="predictionHolder" title="<?=$prediction->PredictionLabelFull?>">
                                                        <label class="PredictionLabelFull"><?=property_exists($prediction, 'PredictionLabelFull') ? \Util\Helper::GetPredictionLabel($prediction->HomeTeam->TeamName, $prediction->AwayTeam->TeamName, $prediction->PredictionLabelFull): \Util\Helper::GetPredictionLabel($prediction->HomeTeam->TeamName, $prediction->AwayTeam->TeamName,$prediction->Prediction)?></label>

                                                        <?php if(\Util\Helper::DisplayHint($prediction->HomeTeam, $prediction->AwayTeam)):?>
                                                            <div class="hint <?=\Util\Helper::GetPredictionBg($prediction->Percentage)?>">
                                                                <label for=""><?=\Util\Helper::GetPredictionHint($prediction->Percentage)?></label>
                                                            </div>
                                                        <?php endif?>

                                                        <?php if(property_exists($prediction, 'MlPrediction')) : ?>
                                                            <div class=" hintResult >">
                                                                <label for=""><?=\Util\Helper::MlCheck($prediction->MlPrediction)?></label>
                                                            </div>
                                                        <?php endif ?>
                                                    </div>

                                                </td>
                                                <td class="txt-capitalized text-center hide <?=\Util\Helper::GetPredictionToBorder($prediction->Percentage)?>">
                                                    <?php

                                                    if($prediction->HomeTeam->TotalPerecentage > $prediction->AwayTeam->TotalPerecentage) {
                                                        echo  $prediction->HomeTeam->TotalPerecentage - $prediction->AwayTeam->TotalPerecentage;
                                                    }
                                                    else {
                                                        echo  $prediction->AwayTeam->TotalPerecentage - $prediction->HomeTeam->TotalPerecentage;
                                                    }

                                                    ?>

                                                </td>
                                                <td  style="" class="txt-capitalized text-center hideOnMobile <?=\Util\Helper::GetPredictionToBorder($prediction->Percentage)?>">
                                                    <?php if($maxPrediction > 0) : ?>
                                                        <button type="button" class="btn btn-default btn viewPredictionBtn" data-toggle="modal" title="<?=$prediction->PredictionLabelFull?>" data-target="#myModal<?=$count?><?=$prediction->UniqueId?>">Prediction Details</button>
                                                    <?php else : ?>
                                                        <a data-toggle="modal" data-target="#mySigninModal">Sign in required</a>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                        <?php endforeach ?>

                                        <?php $count++;?>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
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
    })
</script>
