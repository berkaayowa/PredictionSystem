<?php $banner = $banner[0]?>
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class="mb-3" href="<?= BerkaPhp\Helper\Html::action('/banners')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    List
                </button>
            </a>
            <a  class="mb-0" href="<?= BerkaPhp\Helper\Html::action('/banners/view/'.$banner['ID'])?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                        View Details
                </button>
            </a>
        </div>
    </div>
</div>

<div class="">
    <div class="panel panel-default">
        <form method="POST" id="bannerImageForm" action="<?= BerkaPhp\Helper\Html::action('/banners/image/'.$banner['ID'])?>" enctype="multipart/form-data">
            <div class="panel-body row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <img style="width: auto;" height="370px" id="Banner" src="<?=$banner["Banner"] !== null ? $banner["Banner"] : '/Views/Client/Assets/no-image.png' ?>">
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                            <input type="file" data-file-select="Banner" class="form-control" placeholder="product main image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <input type="hidden" id="ID" name="ID" value="<?=$banner['ID']?>">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div

    <!-- Modal -->
<div class="modal" id="bannerImageModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 880px;">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Cropping...</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div data-croppie-banner></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <span data-crop-btn class="btn btn-primary">Crop</span>
            </div>
        </div>
    </div>
</div>
