<div class="body-content outer-top-bd">
    <div class="container">
        <div class="x-page inner-bottom-sm">
            <div class="row">
                <div class="col-md-12 x-text text-center">
                    <h1><?= isset($model) ? $model['code'] : '404' ?></h1>
                    <p><?= isset($model) ? $model['message'] : 'We are sorry, the page you ve requested is not available' ?></p>
                    <a href="/"><i class="fa fa-home"></i> Go To Homepage</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
    </div><!-- /.container -->
</div><!-- /.body-content -->