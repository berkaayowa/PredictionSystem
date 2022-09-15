

<div class="login-box">
    <div class="login-logo singin-logo">
        <a href=""><b>Soccer Tips</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <p class="error response"> <?=isset($error) ? $error : ''?></p>
        <form data-toggle="validator" message="Signing..." request-type="POST"  data-request="<?= BerkaPhp\Helper\Html::action('/users/signin')?>" response-on=".response" id="login-form" response-type="html"  class="register-form outer-top-xs" role="form">
            <div class="form-group has-feedback">
                <input required type="text" class="form-control" placeholder="Email" name="Email" id="Email" >
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input required type="password" class="form-control" placeholder="Password" name="Password" id="Password" >
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6" style="font-size: 13px;text-align: right">
                    <br>
                    <a href="<?=BerkaPhp\Helper\Html::action('/users/forgotpassword')?>">Forgot Password</a>
                </div>
                <div class="col-xs-6" style="font-size: 13px;text-align:left ">
                    <br>
                    <a href="<?=BerkaPhp\Helper\Html::action('/users/registration')?>" class="text-center">User Registration</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
//        bluetech.initLogin();
//        bluetech.initSignup();
    });
</script>