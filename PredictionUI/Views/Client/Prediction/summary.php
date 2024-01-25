<?=\BerkaPhp\Helper\Element::Render("Breadcrumb", "Client", array("breadcrumb"=>$breadcrumb))?>

<div class="row">

<!--    <div class="col-xs-12">-->
<!--        <div class="box box-solid">-->
<!--            <div class="box-body">-->
<!--                <div class="row">-->
<!--                    <div class="col-xs-12">-->
<!--                        <h5 id="">-->
<!--                            Prediction statistics so far-->
<!--                        </h5>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <div class="col-xs-12">
        <!-- jQuery Knob -->
        <div class="box box-solid">
<!--            <div class="box-header">-->
<!--            </div>-->
            <div class="box-body">
                <div class="row">

                    <div class="col-xs-6 col-md-3 text-center">
                        <input type="text" class="knob" data-min="0" data-max="100" value="<?=number_format((float) $perCountry['percentage'], 1, '.', '')?>%" data-width="90" data-height="90" data-fgColor="<?= \Util\Helper::GetColor($perCountry['percentage'])?>">
                        <div class="knob-label"><?=$prediction->Country?> <br> <?=$perCountry['detail']?></div>
                    </div>
                    <!-- ./col -->
                    <div class="col-xs-6 col-md-3 text-center">
                        <input type="text" class="knob" data-min="0" data-max="100" value="<?=number_format((float) $perLeague['percentage'], 1, '.', '')?>%" data-width="90" data-height="90" data-fgColor="<?= \Util\Helper::GetColor($perLeague['percentage'])?>">
                        <div class="knob-label"><?=$prediction->League?> <br> <?=$perLeague['detail']?></div>
                    </div>
                    <!-- ./col -->
                    <div class="col-xs-6 col-md-3 text-center">
                        <input type="text" class="knob" value="0" data-min="-150" data-max="150" data-width="90" data-height="90" data-fgColor="#00a65a">
                        <div class="knob-label">Team</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-xs-6 col-md-3 text-center">
                        <input type="text" class="knob" value="0" data-width="90" data-height="90" data-fgColor="#00c0ef">
                        <div class="knob-label">Option</div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(\Util\Helper::GetCurrentUserSubscription()->showPreviousPrediction == \Helper\Check::$True):  ?>
<div class="row">
    <div class="col-sm-12">

        <div class="box  box-default breadcrumb-box">
            <div class="box-body">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#profile" data-toggle="tab"><?=$prediction->League?> Past Predictions</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="profile">
<!--                        <div class="fixtureTable">-->
                            <table class=" dataTablePaging table table-striped predictionTable">
                                <thead class="thead-inverse">
                                <tr class=table-header">
                                    <th class="txt-capitalized text-right wtp underline">
                                        home
                                    </th>
                                    <th class="txt-capitalized text-left wtp underline">
                                        Away
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

                                        <td><?=number_format((float) $previousPrediction->homeTotalPerecentage, 2, '.', '')?></td>
                                        <td><?=number_format((float) $previousPrediction->awayTotalPerecentage, 2, '.', '')?></td>
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
<?php endif;?>

<script>

    $(document).ready(function (e) {
        $('.dataTablePaging').DataTable({
            "order": [0],
            "pageLength": 5,
            paging: true
        });
        $("img.lazy").lazyload({effect : "fadeIn"});

        $(".knob").knob({
            draw: function () {
                if (this.$.data('skin') == 'tron') {

                    var a = this.angle(this.cv)  // Angle
                        , sa = this.startAngle          // Previous start angle
                        , sat = this.startAngle         // Start angle
                        , ea                            // Previous end angle
                        , eat = sat + a                 // End angle
                        , r = true;

                    this.g.lineWidth = this.lineWidth;

                    this.o.cursor
                    && (sat = eat - 0.3)
                    && (eat = eat + 0.3);

                    if (this.o.displayPrevious) {
                        ea = this.startAngle + this.angle(this.value);
                        this.o.cursor
                        && (sa = ea - 0.3)
                        && (ea = ea + 0.3);
                        this.g.beginPath();
                        this.g.strokeStyle = this.previousColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                        this.g.stroke();
                    }

                    this.g.beginPath();
                    this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                    this.g.stroke();

                    this.g.lineWidth = 2;
                    this.g.beginPath();
                    this.g.strokeStyle = this.o.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                    this.g.stroke();

                    return false;
                }
            }
        });

    })
</script>