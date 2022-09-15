<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-header btn-brd">
                <a href="<?= BerkaPhp\Helper\Html::action('/credits/purchases')?>" class="btn btn-default">
                    <i class="fa fa-list"></i> <?=Resource\Label::General("Purchase History")?>
                </a>

                <a class="btn btn-default pull-right" data-back-link>
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    <?=Resource\Label::General("Back")?>
                </a>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <form id="buyForm" message="Please sms order..." request-type="POST" data-request="<?= BerkaPhp\Helper\Html::action('/credits/placeorder')?>" >
                                    <fieldset data-eq>
                                        <legend>
                                            Purchase Details
                                        </legend>
                                        <div class="form-group">
                                            <select name="PaymentMethod" id="PaymentMethod" name="PaymentMethod" class="form-control">
                                                <option value="">Select Payment Method</option>
                                                <?php if(sizeof($methods) > 0): ?>
                                                    <?php foreach ($methods as $method ): ?>
                                                        <option value="<?=$method->id?>"><?=$method->name?></option>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="number"  placeholder="Enter Quantity" id="Quantity" name="Quantity" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <div class="cost-break-down">
                                                <div class="details-loading text-center hide">
                                                    <span class="loading-text">
                                                        Calculating...
                                                    </span>
                                                    <br/>
                                                    <img src="/Views/Client/Assets/loader.gif" alt=""/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <button type="submit" class="btn btn-primary">Next</button>
                                                <a href="/dashboard/message" class="btn btn-default">Cancel</a>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <fieldset data-eq>
                            <legend>
                                Credits Pricing (Excl @VAT)
                            </legend>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-inverse">
                                    <tr class="table-header header-table">
                                        <th class="txt-capitalized">Quantity</th>
                                        <th class="txt-capitalized">Price / sms</th>
                                    </tr>
                                    </thead>
                                    <tbody class="pricing">
                                    <?php if(sizeof($prices) > 0): ?>
                                        <?php foreach ($prices as $price ): ?>
                                            <tr>
                                                <td><?=$price->start?> to <?=$price->end?></td>
                                                <td>R<?=$price->price?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                    </tbody>
                                </table>
                                <div>
                                    <h5>Payment Details (for Bank Deposit / Transfer Method)</h5>
                                    <hr/>
                                    <strong>Bank Name: Bidvest Bank<br>
                                        Account Name: Softclick Tech (Pty) Ltd<br>
                                        Account Number: 11602150401<br>
                                        Branch Code: 462005<br>
                                        Reference: <?=\BerkaPhp\Helper\Auth::GetActiveUser(false)->accountNumber?><br><br>
                                    </strong>
                                   <p><span style="color: red;">For all payments done via bank deposit / transfer , proof of payments should be emailed to payment@softclicktech.com</span></p>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
//        mts.initPriceCalculation('#Quantity');
    })
</script>