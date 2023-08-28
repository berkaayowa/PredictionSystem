
<div class="box  box-default breadcrumb-box">
    <div class="box-body">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <?php foreach ($model["breadcrumb"] as $prediction ): ?>
                    <?php if ($prediction == end($model["breadcrumb"])):?>
                        <li class='activec'><?=$prediction?><span class="breadcrumb-divider last"></span></li>
                    <?php else: ?>
                        <li><?=$prediction?><span class="breadcrumb-divider">/</span></li>
                    <?php endif ?>
                <?php endforeach ?>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div>
</div>
