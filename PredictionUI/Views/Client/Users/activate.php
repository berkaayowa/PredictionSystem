<div class="body-content">
    <div class="container">
        <div class="terms-conditions-page">
            <div class="row">
                <div class="col-md-12 terms-conditions">
                    <div class="success text-center">
                        <h2 class=" text-center bold">
                            <?= isset($success) ? 'Activation Success' : 'Opp ! error'?>
                        </h2>
                        <div class="co">
                            <div class="result-payment-text">
                                <p>
                                   <?= $verificationMessage ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <?= BerkaPhp\Helper\Element::Render("Partner", "Client") ?>
    </div>
</div>

