<?php $data = $template_data['product'][0]; ?>
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class="mb-3" href="<?= BerkaPhp\Helper\Html::action('/products')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    List
                </button>
            </a>
            <a  class="mb-0" href="<?= BerkaPhp\Helper\Html::action('/products/view/'.$data['ProductID'])?>">
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
        <form method="POST" id="productForm" action="<?= BerkaPhp\Helper\Html::action('/products/edit/'.$data['ProductID'])?>" enctype="multipart/form-data">
        <div class="panel-body row">
            <div class="col-sm-4 col-md-4 col-lg-4 text-center">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <img  style="width: auto;" height="250px" id="ProductMainImage" src="<?=$data["ProductMainImage"] != null ? $data["ProductMainImage"] : '/Views/Client/Assets/no-image.png' ?>">
                    </div>
                    <div class="col-sm-12">
                        <input type="file" data-file-select="ProductMainImage" class="form-control " name="ProductMainImage" id="ProductMainImage" value="<?=$data["ProductMainImage"]?>" placeholder="product main image">
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-md-4 col-lg-4 text-center">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <img  style="width: auto;" height="250px" id="ProductSecondImage" src="<?=$data["ProductSecondImage"] != null ? $data["ProductSecondImage"] : '/Views/Client/Assets/no-image.png' ?>">
                    </div>
                    <div class="col-sm-12">
                        <input type="file" data-file-select="ProductSecondImage" class="form-control " name="ProductSecondImage" id="ProductSecondImage" value="<?=$data["ProductSecondImage"]?>" placeholder="product second image">
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-md-4 col-lg-4 text-center">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <img  style="width: auto;" height="250px" id="ProductThirdImage" src="<?=$data["ProductThirdImage"] != null ? $data["ProductThirdImage"] : '/Views/Client/Assets/no-image.png' ?>">
                    </div>
                    <div class="col-sm-12">
                        <input type="file" data-file-select="ProductThirdImage" class="form-control " name="ProductThirdImage" id="ProductThirdImage" value="<?=$data["ProductThirdImage"]?>" placeholder="product third image">
                    </div>
                </div>
            </div>
        
        </div>
        <div class="panel-footer">
            <input type="hidden" id="ProductID" name="ProductID" value="<?=$data['ProductID']?>">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

        </form>
    </div>
</div

<!-- Modal -->
<div class="modal" id="productImageModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 742px;">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Cropping...</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div data-croppie></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <span data-crop-btn class="btn btn-primary">Crop</span>
            </div>
        </div>
    </div>
</div>
