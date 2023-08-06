<!DOCTYPE html>
<html lang="en">
<head>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1836789549483504"
            crossorigin="anonymous"></script>
    <?=isset($meta_data) && !empty($meta_data) ? $meta_data : "" ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="Unlock your winning potential with our free daily soccer betting tips and predictions!">
    <meta name="author" content="soccerprediction.co.za">
    <meta name="keywords" content="soccertips, soccerprediction, soccerpredictor bettingtips, soccer, bettings, soccerbet, free">
    <meta name="robots" content="all">
    <title><?= empty($title) ? SYS_NAME : ucfirst($title) ?></title>
    <link rel="shortcut icon" href="<?= LOGO_ICON ?>" type="image/x-icon">

    <?= BerkaPhp\Helper\Element::Render('css') ?>
    <?= BerkaPhp\Helper\Element::Render('Style') ?>
</head>
<body class="hold-transition ">
    <div class="page-container">
        <div class="content-wrap">
            <div class="container-fluid headerWrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="headerSection">
                                <div class="navbarWrapper">
                                    <nav class="navbar navbar-inverse navStyle">
                                        <div class="container-fluid">
                                            <div class="navbar-header">
                                                <a class="navbar-brand" href="/">Soccer Prediction</a>
                                            </div>
                                            <ul class="nav navbar-nav navbar-left">
                                                <li class="active"><a href="/">Today's Matches</a></li>
                                                <li class=""><a href="/">Coupons</a></li>
                                            </ul>
                                            <ul class="nav navbar-nav navbar-right">

                                                <li class="hide"><a href="/contact">Contacts Us</a></li>
                                                <li class=""><a href="/pages/about">About Us</a></li>

                                                <?php if(\BerkaPhp\Helper\Auth::IsUserLogged()): ?>
                                                    <li><a href="/users/profile"><i class="glyphicon glyphicon-user"></i> Hi, <?= ucfirst( BerkaPhp\Helper\Auth::GetActiveUser()->name)?></a></li>
                                                    <li><a href="/users/logout"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
                                                <?php else: ?>
                                                    <li class=""><a data-toggle="modal" data-target="#mySignupModal"><span class=""></span> Sign Up</a></li>
                                                    <li class=""><a data-toggle="modal" data-target="#mySigninModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                                                <?php endif ?>

                                            </ul>
                                        </div>
                                    </nav>
                                    <div class="headerSubTitle hide">Unlock your winning potential with our free daily soccer betting tips and predictions! Our expert analysis, statistical insights, and strategic guidance to take your betting game to the next level.
                                        The platform combines accurate predictions from AI processing with detailed insights to empower you like never before. consider subscribing to get more out of soccer prediction platform
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <? if(!empty(\Util\Helper::GetNotificationMessage())) :?>
                <div class="container">
                    <div class="alert alert-info" role="alert"><?=\Util\Helper::GetNotificationMessage()?></div>
                </div>
            <? endif ?>

            <div class="container">
                {content}
            </div>
        </div>

        <div class="footer">
            <div class="container footerContainer">
        <!--        <a href='#'><i class="fa fa-twitch fa-3x fa-fw"></i></a>-->
                <a target="_blank" href='https://www.facebook.com/profile.php?id=100094880164648'><i class="fa fa-facebook fa-3x fa-fw"></i></a>
                <a target="_blank" href='https://www.youtube.com/@soccerprediction27/about'><i class="fa fa-youtube-play fa-3x fa-fw"></i></a>
                <div class="copyRight">
                    ©<?= date("Y").' '. $_SERVER['SERVER_NAME']?> All rights reserved. <a href="/pages/policy">Our Policy</a>
                </div>
                <div class="cookieInfo">
                    This website uses cookies for content/ads personalization and to analyse our traffic.
                </div>
            </div>
        </div>
    </div>

    <div id="mySigninModal" class="modal fade" role="dialog">
        <div class="modal-dialog loginModal">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title center">Log in</h4>
                </div>
                <div class="modal-body">
                    <div class="login-form">
                        <form data-toggle="validator" message="Login..." request-type="POST" id="formLogin" data-request="/users/login">
                            <div class="form-group">
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password"  class="form-control" placeholder="Password" required="required">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Log in</button>
                            </div>
                            <div class="clearfix">
                                <label class="pull-left"><input type="checkbox"> Remember me</label>
                                <a href="#" class="pull-right bold">Forgot Password?</a>
                            </div>
                        </form>
                        <p class="text-center hidden"><a href="#">Create an Account</a></p>
                    </div>
                </div>
                <div class="modal-footer hide">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="mySignupModal" class="modal fade" role="dialog">
        <div class="modal-dialog loginModal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title center">Fill all the below fields & click 'Registration'</h4>
                </div>
                <div class="modal-body">
                    <div class="login-form">
                        <form data-toggle="validator" message="Signing up..." request-type="POST" id="formLogin" data-request="/users/signup">
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required="required">
                            </div>
                            <div class="form-group">
                                <input type="text" name="surname" id="surname" class="form-control" placeholder="Surname" required="required">
                            </div>
                            <div class="form-group">
                                <input type="text" name="emailAddress" id="emailAddress" class="form-control" placeholder="Email Address" required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" autocomplete="false" name="password" id="password" class="form-control" placeholder="Password" required="required">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Register</button>
                            </div>
                            <div class="clearfix">
                                <label class="pull-left">
                                    <a href="">Sign in</a>
                                </label>
                                <a href="#" class="pull-right bold">Forgot Password ?</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer hide">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script src="/Views/Shared/Scripts/Bootstrap/bootstrap.js"></script>
<script src="/Views/Shared/Scripts/Bootstrap/jquery.bootstrap-growl.js"></script>
<script src="/Views/Shared/Scripts/Other/jquery.knob.js"></script>
<script src="/Views/Shared/Scripts/Other/moment.js"></script>
<script src="/Views/Shared/Scripts/Bootstrap/bootstrap-datepicker.js"></script>
<script src="/Views/Shared/Scripts/Bootstrap/bootstrap-timepicker.js"></script>
<script src="/Views/Shared/Scripts/Bootstrap/daterangepicker.js"></script>
<script src="/Views/Shared/Scripts/Other/Jquery_table.js"></script>
<script src="/Views/Shared/Scripts/Other/datatables.js"></script>
<script src="/Views/Shared/Scripts/Other/jquery-confirm.js"></script>
<script src="/Views/Shared/Scripts/Other/jquery.slimscroll.js"></script>
<script src="/Views/Shared/Scripts/Bootstrap/bootstrap3-wysihtml5.all.js"></script>
<script src="/Views/Shared/Scripts/Theme/adminlte.js"></script>
<script src="/Views/Shared/Scripts/Other/loader.js"></script>
<script src="/Views/Shared/Scripts/Select2/select2.full.js"></script>
<script src="/Views/Shared/Scripts/Other/notification.js"></script>
<script src="/Views/Shared/Scripts/Ckeditor/ckeditor.js"></script>
<script src="/Views/Shared/Scripts/Theme/dashboard.js"></script>
<script src="/Views/Shared/Scripts/Theme/app.js"></script>
<script src="/Views/Shared/Scripts/Site.js"></script>

<script src="/Views/Client/Layout/js/bootstrap-slider.min.js"></script>
<script src="/Views/Client/Layout/js/lightbox.min.js"></script>
<script src="/Views/Client/Layout/js/bootstrap-select.min.js"></script>
<script src="/Views/Client/Layout/js/softclick_search_select.js"></script>
<script src="/Views/Client/Layout/js/loader.js"></script>
<script src="/Views/Client/Layout/js/notification.js"></script>
<script src="/Views/Admin/Layout/js/jquery.dataTables.js"></script>
<script src="/Views/Admin/Layout/js/dataTables.bootstrap4.js"></script>
<script src="/Views/Admin/Layout/js/summernote-bs4.js"></script>
<script src="/Views/Client/Layout/js/confirmation.js"></script>
<script src="/Views/Client/Layout/js/colors.js"></script>
<script src="/Views/Client/Layout/js/jqColorPicker.js"></script>
<script src="/Views/Client/Layout/js/color-picker.js"></script>

<script src="/Views/Shared/Scripts/Theme/Chart.js"></script>
<script src="/Views/Client/Layout/js/mts.js"></script>


