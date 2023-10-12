<div class="row">
<div class="col-xs-12">

    <div class="panel-heading text-left cpanel-header">
        <?php if(\BerkaPhp\Helper\Auth::IsUserLogged()): ?>
            <form class=" " message="<?=Resource\Label::General("Commenting")?>..."  request-type="POST" id="request" data-request="<?= BerkaPhp\Helper\Html::action('/prediction/comments/'.$predictionId)?>">
            <div class="row">
                <div class="col-sm-10 col-md-11">
                    <div class="form-group">
                        <textarea required placeholder="Your Comment" id="comment" name="comment" class="form-control full-width" rows="1"></textarea>
                    </div>
                </div>
                <div class="col-sm-2 col-md-1">
                    <div class="form-group">
                        <button type="submit" class="btn btn-default form-control">Post</button>
                    </div>
                </div>
            </div>
        </form>
        <?php else: ?>
            <a data-toggle="modal" data-target="#mySigninModal">Sign in to comment.</a>
        <?php endif ?>
    </div>

    <?php if(sizeof($comments) > 0): ?>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <section class="comments">
                    <?php foreach ($comments as $comment ): ?>
                    <article class="comment">
                        <div class="comment-body">
                            <div class="text">
                                <p class="attribution">by <a ><?= ucfirst($comment->user->name)?> <?= ucfirst($comment->user->surname)?> </a> at <?=date('h:i A d/m/Y', strtotime($comment->createdDate))?></p>
                                <p><?=$comment->content?></p>
                            </div>
                        </div>
                    </article>
                    <?php endforeach ?>
                </section>
            </div>
        </div>
    </div>
    <?php endif ?>
</div>
</div>



<script>
    mts.initFormRequest();
</script>