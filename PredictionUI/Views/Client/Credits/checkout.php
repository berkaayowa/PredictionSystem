<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <form id="checkoutForm" method="post" action="<?=$link?>">
            <?php if(sizeof($inputs) > 0): ?>
                <?php foreach ($inputs as $name => $value ): ?>
                    <input type="hidden" name="<?=$name?>" value="<?=$value?>" id="<?=$name?>"/>
                <?php endforeach ?>
            <?php endif ?>
            <fieldset data-eq>
                <legend>
                    You are about to go to a secure payment page.
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
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-danger btn-block">Pay Now</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6 hide">
        <fieldset data-eq>
            <legend>
                Important notes
            </legend>
            <div>
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