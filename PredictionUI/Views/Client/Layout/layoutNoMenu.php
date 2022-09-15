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
    <title><?= empty($title) ? 'Soccer Prediction' : ucfirst($title) ?></title>
    <link rel="shortcut icon" href="<?= LOGO_ICON ?>" type="image/x-icon">

    <?= BerkaPhp\Helper\Element::Render('css') ?>
    <?= BerkaPhp\Helper\Element::Render('Style') ?>
</head>
<body class="hold-transition ">
    {content}
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


