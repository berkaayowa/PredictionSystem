<?=\BerkaPhp\Helper\Element::Render("Breadcrumb", "Client", array("breadcrumb"=>$breadcrumb))?>
<div class="row">
    <div class="col-sm-12">
        <div class="box box-default">
            <div class="box-header btn-brd">
                <a href="<?= BerkaPhp\Helper\Html::action('/template')?>" class="btn btn-default">
                    <i class="fa fa-list"></i> <?=Resource\Label::General("View All Templates")?>
                </a>

                <a class="btn btn-default pull-right" data-back-link>
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    <?=Resource\Label::General("Back")?>
                </a>

            </div>
            <div class="box-body">
                <form id="userForm" message="Processing..." request-type="POST" data-request="<?= BerkaPhp\Helper\Html::action('/template/update/')?><?=$pTemplate->IsAny() > 0 ? $pTemplate->id : ''?>">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-label-group">
                                            <label for="firstName">Template Name</label>
                                            <div class="input-group">
                                                <input value="<?=$pTemplate->IsAny()  > 0 ? $pTemplate->name : ''?>" type="text" required autocomplete="off" class="form-control" name="name" id="name">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-info"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-label-group">
                                            <label for="lastName">Template Description</label>
                                            <textarea rows="1" class="form-control" required name="description" id="description"><?=$pTemplate->IsAny()  > 0 ? $pTemplate->description : ''?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-label-group">
                                            <label for="firstName">League Points Percentage</label>
                                            <div class="input-group">
                                                <input value="<?=$pTemplate->IsAny()  > 0 ? $pTemplate->leaguePointsPercentage : ''?>" required autocomplete="off" type="number" class="form-control" name="leaguePointsPercentage" id="leaguePointsPercentage">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-earlybirds">%</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        <div class="form-label-group">
                                            <label for="firstName">League Position Percentage</label>
                                            <div class="input-group">
                                                <input value="<?=$pTemplate->IsAny() > 0 ? $pTemplate->leaguePositionPercentage : ''?>" required autocomplete="off" type="number" class="form-control" name="leaguePositionPercentage" id="leaguePositionPercentage">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-earlybirds">%</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        <div class="form-label-group">
                                            <label for="firstName">Game Location</label>
                                            <div class="input-group">
                                                <input value="<?=$pTemplate->IsAny()  > 0 ? $pTemplate->awayHomePercentage : ''?>" required autocomplete="off" type="number" class="form-control" name="awayHomePercentage" id="awayHomePercentage">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-earlybirds">%</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        <div class="form-label-group">
                                            <label for="firstName">Head 2 Head Percentage</label>
                                            <div class="input-group">
                                                <input value="<?=$pTemplate->IsAny()  > 0 ? $pTemplate->head2headPercentage : ''?>" required autocomplete="off" type="number" class="form-control" name="head2headPercentage" id="head2headPercentage">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-earlybirds">%</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        <div class="form-label-group">
                                            <label for="firstName">Number Of Head 2 Head</label>
                                            <input value="<?=$pTemplate->IsAny()  > 0 ? $pTemplate->numberOfHeadtohead : ''?>" required autocomplete="off" type="number" class="form-control" name="numberOfHeadtohead" id="numberOfHeadtohead">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        <div class="form-label-group">
                                            <label for="firstName">Motivation Based On Last Games Played</label>
                                            <div class="input-group">
                                                <input value="<?=$pTemplate->IsAny()  > 0 ? $pTemplate->lastMatchPlayedPercentage : ''?>" required autocomplete="off" type="number" class="form-control" name="lastMatchPlayedPercentage" id="lastMatchPlayedPercentage">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-earlybirds">%</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        <div class="form-label-group">
                                            <label for="firstName">Number Of Last Game Played</label>
                                            <input value="<?=$pTemplate->IsAny()  > 0 ? $pTemplate->numberOfLastMatch : ''?>" required autocomplete="off" type="number" class="form-control" name="numberOfLastMatch" id="numberOfLastMatch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        <div class="form-label-group">
                                            <label for="firstName">Win Difference</label>
                                            <div class="input-group">
                                                <input value="<?=$pTemplate->IsAny()  > 0 ? $pTemplate->winDifference : ''?>" required autocomplete="off" type="number" class="form-control" name="winDifference" id="winDifference">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-earlybirds">%</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        <div class="form-label-group">
                                            <label for="firstName">Win/Draw Difference</label>
                                            <div class="input-group">
                                                <input value="<?=$pTemplate->IsAny()  > 0 ? $pTemplate->winDrawDifference : ''?>" required autocomplete="off" type="number" class="form-control" name="winDrawDifference" id="winDrawDifference">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-earlybirds">%</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        <div class="form-label-group">
                                            <label for="firstName">Draw Difference</label>
                                            <div class="input-group">
                                                <input value="<?=$pTemplate->IsAny()  > 0 ? $pTemplate->drawDifference : ''?>" required autocomplete="off" type="number" class="form-control" name="drawDifference" id="drawDifference">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-earlybirds">%</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        <div class="form-label-group">
                                            <label for="firstName">Match Pickup Percentage</label>
                                            <div class="input-group">
                                                <input value="<?=$pTemplate->IsAny()  > 0 ? $pTemplate->matchSelectionPercentage : ''?>" required autocomplete="off" type="number" class="form-control" name="matchSelectionPercentage" id="matchSelectionPercentage">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-earlybirds">%</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">
                            <?=Resource\Label::General("Save", '', true)?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('.paramBtn').on('click', function(e) {

            var name = $(this).attr('name');
            var val = $('#contentTemplate').val();
            $('#contentTemplate').val(val + name + ' ');
            $('#contentTemplate').focus();
        })

    })

</script>
