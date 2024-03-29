<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default ">
            <div class="box-body ">
                <h3 class="headerFocus">Coupon Prediction Filter </h3>
                <p class="pSubHeaderx">
                    The "Prediction Filter" is a filter used in our platforms to help users refine their selections for creating game coupons or teams.
                    It offers several criteria to customize the predictions based on user preferences. <a href="/pages/predictionfilters" style="text-decoration: underline">Click here to read more </a>
                    about our "Game Prediction Filter"
                </p>
                <?= $request->IsAny() ? '<hr><h4 class="headerFocusx">Request: <span class="label label-info">' . $request->description . '</span> Prediction Template: <span class="label label-info">' . $request->configuration->name .'</span></h4>': ''?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default ">
            <div class="box-body ">

                <form class="frmSearch row" message="<?=Resource\Label::General("Requesting")?>..."  method="get" id="requestx"  action="<?= BerkaPhp\Helper\Html::action('/coupons/index/'.$request->id)?>">
                    <div class="col-sm-12 colFrmSearch">
                        <div class="row">
                            <div class="col-xs-12 col-sm-2 col-md-2">
                                <div class="form-group">
                                    <label class="label label-default" for="firstName">Number Of Games Per Coupon</label>
                                    <input value="5" required autocomplete="off" type="number" class="form-control" name="numberOfGamesPerCoupon" id="numberOfGamesPerCoupon">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-2 col-md-2">
                                <div class="form-group">
                                    <label class="label label-default" for="firstName">Number Of Games Per League</label>
                                    <input value="2" required autocomplete="off" type="number" class="form-control" name="numberOfGamesPerLeague" id="numberOfGamesPerLeague">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-2 col-md-2">
                                <div class="form-group">
                                    <label class="label label-default" for="firstName">League Points % >=</label>
                                    <input value="0" required autocomplete="off" type="number" class="form-control" name="leaguePointPercentageOverOREqual" id="leaguePointPercentageOverOREqual">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-2 col-md-2">
                                <div class="form-group">
                                    <label class="label label-default" for="firstName">Game Motivation % >=</label>
                                    <input value="0" required autocomplete="off" type="number" class="form-control" name="gameMotivation" id="gameMotivation">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-2 col-md-2">
                                <div class="form-group">
                                    <label class="label label-default" for="firstName">Head 2 Head % >=</label>
                                    <input value="0" required autocomplete="off" type="number" class="form-control" name="h2hPercentage" id="h2hPercentage">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-2 col-md-2">
                                <div class="form-group">
                                    <label class="label label-default" for="firstName">Game Location</label>
                                    <?= Util\Helper::select('gameLocation', [['id'=>'0','label'=>'Default'],['id'=>'1','label'=>'Home'],['id'=>'2','label'=>'Away']], ['value'=>'id', 'class'=>'form-control', 'data-dropdrown'=>true, 'required'=>true], function($data) {
                                        return $data['label'];
                                    }) ?>
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6 ">
                                <div class="form-label-groupx">
                                    <label class="label label-default" for="firstName">Leagues</label>
                                    <?= Util\Helper::MultipleSelect('leagueId[]', $leagues, ['value'=>'value', 'class'=>'form-control h150px', 'multiple'=>'multiple', 'data-static-dropdown'=>true], function($data) {
                                        return $data['text'];
                                    }) ?>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4 ">
                                <div class="form-label-groupx">
                                    <label class="label label-default" for="firstName">Prediction</label>
                                    <?= Util\Helper::MultipleSelect('options[]', [['id'=>'Win_at','label'=>'Win'],['id'=>'Win/Draw_at','label'=>'Win/Draw'], ['id'=>'Draw_at','label'=>'Draw']], ['value'=>'id', 'class'=>'form-control', 'multiple'=>'multiple', 'data-static-dropdown'=>true, 'required'=>true], function($data) {
                                        return $data['label'];
                                    }) ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-2 col-md-2">
                                <div class="form-group">
                                    <label class="label label-default" for="firstName">Allow Duplicated Game</label>
                                    <?= Util\Helper::select('allowedDuplicateGame', [['id'=>'2','label'=>'No'],['id'=>'1','label'=>'Yes']], ['value'=>'id', 'class'=>'form-control', 'data-dropdrown'=>true, 'required'=>true], function($data) {
                                        return $data['label'];
                                    }) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
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
                </form>
            </div>

        </div>
    </div>
</div>
