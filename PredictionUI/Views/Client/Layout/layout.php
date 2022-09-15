<!DOCTYPE html>
<html lang="en">
<head>

    <?=isset($meta_data) && !empty($meta_data) ? $meta_data : "" ?>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="Computer repair, pc repair, laptop">
    <meta name="robots" content="all">
    <title><?= empty($title) ? SYS_NAME : ucfirst($title) ?></title>
    <link rel="shortcut icon" href="<?= LOGO_ICON ?>" type="image/x-icon">
    <?= BerkaPhp\Helper\Element::Render('css') ?>
    <?= BerkaPhp\Helper\Element::Render('Style') ?>
    <script src="/Views/Shared/Scripts/Other/jquery-1.10.2.min.js"></script>

    <?php
    $yes = BerkaPhp\Helper\SessionHelper::get('navigation') == "off";
    $_body =  $yes ? "sidebar-collapse" : "";
    $cwrapper = $yes ? "min-height: 440px" : "" ;
    ?>


</head>
<body class="hold-transition skin-blue sidebar-mini <?=$_body?>" style="overflow-x: hidden;">
<div class="se-pre-con"></div>
<div class="wrapper">
<header class="main-header">
    <!-- Logo -->
    <a href="<?= BerkaPhp\Helper\Html::action('/')?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <b>I-S</b>
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg" style="text-align: left"><b>I-Send</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-menu-toggle data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav ">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">4</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 4 messages</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- start message -->
                                    <a href="#">

                                        <h4>
                                            Support Team
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Messages: style can be found in dropdown.less-->

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon fa fa-user"></i>
                        <?=Resource\Label::General("Greet")?>
                        <?= ucfirst(BerkaPhp\Helper\Auth::GetActiveUser(false)->name)?>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <p>
                                <?= ucfirst(BerkaPhp\Helper\Auth::GetActiveUser(false)->name)?> <?= ucfirst(BerkaPhp\Helper\Auth::GetActiveUser(false)->surname)?>
                                <small class="txt-lc"><?= BerkaPhp\Helper\Auth::GetActiveUser(false)->email?></small>

                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= BerkaPhp\Helper\Html::action('/users/profile')?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="/client/users/logout" class="btn btn-default btn-flat">
                                    <?=Resource\Label::General("Logout")?>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <section class="sidebar">
        <!--sidebar menu : style can be found in sidebar.less-->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header" style="text-transform: uppercase;">
                &nbsp;
            </li>
            <li class="active">
                <a href="<?= BerkaPhp\Helper\Html::action('/dashboard')?>">
                    <i class="fa fa-dashboard"></i>
                    <span>
                        <?=Resource\Label::General("DashBoard")?>
                    </span>
                </a>
            </li>
            <li class="header">&nbsp;</li>
            <li>
                <a href="<?= BerkaPhp\Helper\Html::action('/contacts')?>">
                    <i class="fa fa-users"></i> <span><?=Resource\Label::General("Contacts")?></span>
                </a>
            </li>
            <li>
                <a href="<?= BerkaPhp\Helper\Html::action('/message')?>">
                    <i class="fa fa-envelope"></i> <span><?=Resource\Label::General("Message")?></span>
                </a>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-phone"></i>
                    <span><?=Resource\Label::General("Top-Up")?></span>
                    <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li>
                        <a href="<?= BerkaPhp\Helper\Html::action('/credits/buycredit')?>">
                            <i class="fa fa-circle-o"></i><span> <?=Resource\Label::General("Top-Up Now")?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= BerkaPhp\Helper\Html::action('/credits/purchases')?>">
                            <i class="fa fa-circle-o"></i> <span> <?=Resource\Label::General("Top-Up History")?></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="header">&nbsp;</li>
            <li>
                <a href="<?= BerkaPhp\Helper\Html::action('/dashboard/api')?>">
                    <i class="fa fa-connectdevelop"></i> <span><?=Resource\Label::General("API")?></span>
                </a>
            </li>

            <li class="header">&nbsp;</li>
            <li>
                <a href="/client/users/logout">
                    <i class="fa fa-sign-out"></i>
                    <span>
                         <?=Resource\Label::General("Logout")?>
                    </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<div class="content-wrapper" style="<?=$cwrapper?>">
    <section class="content-header">
        <h1>
            <?=!empty($breadcrumb) ? $breadcrumb : ""?>
            <small><?=!empty($menuTitle) ? $menuTitle : ""?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i><?=!empty($breadcrumb) ? $breadcrumb : ""?></a></li>
            <li class="active"><?=!empty($menuTitle) ? $menuTitle : ""?></li>
        </ol>
    </section>
    <section class="content">
        <div data-notification-area></div>
        {content}
    </section>
</div>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Powered By </b> <?=ucfirst("ISendUGet")?>
    </div>
    <strong><?=ucfirst("I-Send")?></strong>
</footer>
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



