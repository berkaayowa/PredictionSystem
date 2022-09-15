<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <fieldset data-eq>
            <legend>
                Order Price Break Down
            </legend>

            <table class="table">
                <thead class="thead-inverse">
                <tr class="table-header header-table">
                    <th class="txt-capitalized">Quantity</th>
                    <th class="txt-capitalized">Price / sms</th>
                    <th class="txt-capitalized">Total</th>
                </tr>
                </thead>
                <tr>
                    <td><?=$order->credits?></td>
                    <td>R<?=$order->pricePerUnit?></td>
                    <td>R<?=($order->amount - $order->totalTax)?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>VAT(15%)</td>
                    <td>R<?=$order->totalTax?></td>
                </tr>
                <tr style="font-weight: bolder">
                    <td></td>
                    <td>Total Amount Due</td>
                    <td>R<?=$order->amount?></td>
                </tr>
                <tbody>

                </tbody>
            </table>
        </fieldset>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
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

            <div>
                <hr/>
                <h5>Payment Details (for Bank Deposit / Transfer Method)</h5>
                <hr/>
                <strong>Bank Name: Bidvest Bank<br>
                    Account Name: Softclick Tech (Pty) Ltd<br>
                    Account Number: 11602150401<br>
                    Branch Code: 462005<br>
                    Reference: <?=\BerkaPhp\Helper\Auth::GetActiveUser(false)->accountNumber?><br><br>
                </strong>
                <span style="color: red;">For all payments done via bank deposit / transfer , proof of payments should be emailed to payment@softclicktech.com</span>
            </div>

        </fieldset>
    </div>
</div>