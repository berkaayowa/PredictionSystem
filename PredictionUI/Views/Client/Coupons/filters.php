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

                            <div class="form-group col-sm-12 ">
                                <div class="form-label-groupx">
                                    <label class="label label-default" for="firstName">Leagues</label>
                                    <?= Util\Helper::select('leagueId[]', $leagues, ['value'=>'value', 'class'=>'form-control h150px', 'multiple'=>'multiple', 'data-static-dropdown'=>true], function($data) {
                                        return $data['text'];
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
