<div class="row">
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
            </div>
        </fieldset>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="row">
            <div class="col-sm-12">
                <form id="buyForm" message="Please sms order..." request-type="POST" data-request="<?= BerkaPhp\Helper\Html::action('/credits/placeorder')?>" >
                    <fieldset data-eq>
                        <legend style="color: red;">
                            How to notify us after paying for your order
                        </legend>
                        Please Note that all <strong style="color: red;">proof of payment</strong> done through Deposit or transfer should be email to <string style="color: red;">payment@softclicktech.com</string> and as reference please use your <strong>order number</strong>,
                        and credit will be loaded into your account after we successfully receive your payment.
                        <br/><br/>
                        this takes about 1-3 working days if transfer is done from different bank.
                        <br/><br/>
                        If credits is needed urgently we strongly recommend you to chose <strong style="color: red;">Online Payment (EFT)</strong> as payment method for your order as this method credit get loaded <strong>as soon as you pay for your order</strong>.
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
