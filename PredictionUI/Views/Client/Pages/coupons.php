
<?php if(!\BerkaPhp\Helper\Auth::IsUserLogged()): ?>
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

<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default ">
            <div class="box-body row ">
                <div class=" col-sm-9 colFrmSearch">
                    <form class="frmSearch row" message="<?=Resource\Label::General("Searching")?>..."  method="GET" id="transactionSearch" ACTION="<?= BerkaPhp\Helper\Html::action('/pages/index')?>">
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
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if(true): ?>
                            <div class="txt-capitalized text-center">No coupons available</div>
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

            }, 600);


        $(window).scroll(function() {
            var scroll = $(window).scrollTop();

            //>=, not <=
            if (scroll >= 200) {
                //clearHeader, not clearheader - caps H
                $("#HeaderSectionH").addClass("floatingHeaderSection");
            }
            else {
                $("#HeaderSectionH").removeClass("floatingHeaderSection");
            }
        });

    })
</script>
