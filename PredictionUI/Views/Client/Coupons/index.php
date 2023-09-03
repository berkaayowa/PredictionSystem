<?php $count = 1;?>

<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default ">
            <div class="box-body ">
                <h3 class="headerFocus">Prediction Coupons</h3>
                <p class="pSubHeaderx">
                    You can always update/change your filters below, it helps to refine your selections for creating game coupons and .
                    It offers several criteria to customize the predictions based on user preferences. <a class="hide" href="/pages/predictionfilters" style="text-decoration: underline">Click here to read more </a>
                </p>
                <?= $request->IsAny() ? '<hr><h4 class="headerFocusx">Request: <span class="lbl-c label label-success">' . $request->description . '</span> Prediction Template: <span class="lbl-c label label-success">' . $request->configuration->name .'</span></h4>': ''?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default ">
            <form class="frmSearchs" message="<?=Resource\Label::General("Requesting")?>..."  method="get" id="requestx"  action="<?= BerkaPhp\Helper\Html::action('/coupons/index/'.$request->id)?>">
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

                        <div class="form-group col-xs-12 col-sm-6 ">
                            <div class="form-label-groupx">
                                <label class="label label-default" for="firstName">Leagues</label>
                                <?= Util\Helper::MultipleSelect('leagueId[]', $leagueIds, ['selected'=> $selectedLeague,'value'=>'value', 'class'=>'form-control h150px', 'multiple'=>'multiple', 'data-static-dropdown'=>true], function($data) {
                                    return $data['text'];
                                }) ?>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4 ">
                            <div class="form-label-groupx">
                                <label class="label label-default" for="firstName">Options</label>
                                <?= Util\Helper::MultipleSelect('options[]', [['id'=>'Win_at','label'=>'Win'],['id'=>'Win/Draw_at','label'=>'Win/Draw'], ['id'=>'Draw_at','label'=>'Draw']], ['selected'=> $options, 'value'=>'id', 'class'=>'form-control', 'multiple'=>'multiple', 'data-static-dropdown'=>true, 'required'=>true], function($data) {
                                    return $data['label'];
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
                            <div class="panel-footerx">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <button type="submit" class="searchBtnHome btn btn-primary btn-themed">
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

<?php \BerkaPhp\Helper\Element::Render("CouponPredictions", "Client", array('shareCode'=>'5', 'predictionRequest'=>$request, 'couponGenerated'=>$couponGenerated))?>