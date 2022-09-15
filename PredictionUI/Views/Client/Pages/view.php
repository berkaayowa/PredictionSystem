<div class="body-content">
    <div class="container">
        <div class="terms-conditions-page">
            <div class="row">
                <div class="col-md-12 terms-conditions">
                    <h2 class="heading-title">
                        <?=$page['Title']?>
                    </h2>
                    <div class="">
                        <?=$page['Content']?>
                    </div>
                </div>
            </div>
        </div>
        <?= BerkaPhp\Helper\Element::Render("Partner", "Client") ?>
    </div>
</div>