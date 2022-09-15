<div class="row">
    <div class="col-sm-12 text-center login-header">
        <a class="" href="/">
            <img src="<?=LOGO?>" alt="Softclick Tech (Pty) Ltd"/>
        </a>
    </div>
</div>
<div class="col-sm-12 col-md-4 col-lg-4 sign-in col-lg-offset-4 col-md-offset-4">
    <div class="sign-in-page">
        <h4 class="">Request Password Reset</h4>

        <form  message="Requesting Password Reset..." request-type="POST"  data-request="<?= BerkaPhp\Helper\Html::action('/users/forgotpassword')?>" response-on=".response" id="reset-form" response-type="html"class="register-form outer-top-xs" role="form">
            <div class="form-group">
                <label class="info-title" for="Email">Email Address <span>*</span></label>
                <input type="email" class="form-control unicase-form-control text-input" name="Email" id="Email" >
            </div>
            <div class="form-group text-center">
                <a href="#" class="forgot-password">
                    <p class="error response"> <?=isset($error) ? $error : ''?></p>
                </a>
            </div>
            <button type="submit" class="btn-upper btn btn-primary login-btn">Request</button>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="information" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content customer-modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center customer-header" id="exampleModalLabel">Registration successful</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center customer-body">
                <p>
                    Thank for trusting us, one more step left to activate your, please click on the link sent to your email address
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
//        bluetech.initLogin();
//        bluetech.initSignup();
    });
</script>