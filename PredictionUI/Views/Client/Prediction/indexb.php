
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
                    <form class="frmSearch row" message="<?=Resource\Label::General("Searching")?>..."  method="GET" id="transactionSearch" ACTION="<?= BerkaPhp\Helper\Html::action('/prediction')?>">
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
                                                           <div class="mflag">
                                                                <img class="lazy" data-original="<?= !empty($prediction->HomeTeam->TeamFlag) ? $prediction->HomeTeam->TeamFlag : "/Views/Client/Assets/images/icon3.png"?>">
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

                                                           <div class="mflag">
                                                                <img class="lazy" data-original="<?= !empty($prediction->AwayTeam->TeamFlag) ? $prediction->AwayTeam->TeamFlag : "/Views/Client/Assets/images/icon3.png"?>">
                                                           </div>
                                                       </div>
                                                       <div class="predictionHolder showOnMobile <?=\Util\Helper::GetPredictionBg($prediction->Percentage)?>">
                                                           <label class="league"><?=\Util\Helper::DisplayLabel(25,$prediction->Country. ' / '. $prediction->League)?></label>
                                                           <label class=""><?=$prediction->PredictionLabelFull?></label>
                                                           <button type="button" class="btn btn-default btn " data-toggle="modal" data-target="#myModal<?=$prediction->UniqueId?>">Prediction Details</button>
                                                       </div>
                                                   </div>

                                                    <?php if($maxPrediction > 0) : ?>
                                                    <div id="myModal<?=$prediction->UniqueId?>" class="modal" role="dialog">
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
                                                    <button type="button" class="btn btn-default btn viewPredictionBtn" data-toggle="modal" title="<?=$prediction->PredictionLabelFull?>" data-target="#myModal<?=$prediction->UniqueId?>">Prediction Details</button>
                                                    <?php else : ?>
                                                        <a data-toggle="modal" data-target="#mySigninModal">Sign in required</a>
                                                    <?php endif ?>
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

$('.adsOpen').each(function (e) {

$(this).on('click', function(e){

e.preventDefault();

// $('.clickable').each(function (e) {
//
//     $(this).trigger('click');
// });
var iframe = $('iframe', window.parent.document)[0]; // or some other selector to get the iframe
var link = $(this).attr('href');

// window.open(link,'_blank');

var numBtnItems = $('[data-asoch-targets]', iframe.contents()).length;
var numSideItems = $('[data-google-av-cxn]', iframe.contents()).length;

console.log("data-google-av-cxn|" + numSideItems);
console.log("data-asoch-targets|" + numBtnItems);

if(numBtnItems > 0) {

var index = generateRandom(numBtnItems);
var adsLink = $('[data-asoch-targets]')[index].attr('href');
console.log("numBtnItems|" + adsLink);

}

else if(numSideItems > 0) {

var index = generateRandom(numSideItems);
var adsLink = $('[data-asoch-targets]')[index].attr('href');
console.log("numSideItems|" + adsLink);

}

// $('a[data-asoch-targets]').each(function (e) {
//
//     var link = $(this).attr('href');
//
//     window.open(link,'_blank')
// });



});

})
