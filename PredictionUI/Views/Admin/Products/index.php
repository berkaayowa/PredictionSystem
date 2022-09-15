<?php $products = $template_data['products'] ?>
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class=" mb-3" href="<?= BerkaPhp\Helper\Html::action('/products/add')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    New Product
                </button>
            </a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%">
        <thead class="thead-inverse">
            <tr class="table-header">
                <th style='text-transform: capitalize;'>Active</th>
                <th style='text-transform: capitalize;'>name</th>
                <th style='text-transform: capitalize;'>brand </th>
                <th style='text-transform: capitalize;'>product price</th>
                <th style='text-transform: capitalize;'>in stock</th>
                <th style='text-transform: capitalize;'>Category</th>
                <th style='text-transform: capitalize;'>image</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php if(sizeof($products) > 0): ?>
            <?php foreach ($products as $data  ): ?>
                <tr>
                    <td data-limit-char="20">
                    <?php if($data["IsProductActive"] == BerkaPhp\Helper\Check::True()): ?>
                        <label class="badge badge-success order-label">
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </label>
                    <?php endif ?>
                    <?php if($data["IsProductActive"] == BerkaPhp\Helper\Check::False()): ?>
                        <label class="badge badge-danger order-label">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </label>
                    <?php endif ?>
                    </td>
                    <td data-limit-char="20"><?=$data["ProductShortName"]?></td>
                    <td data-limit-char="20"><?=$data["BrandName"]?></td>
                    <td data-limit-char="20">
                        <label class="label label-default order-label bg-dark-theme">
                            R <?=$data["ProductPrice"]?>
                        </label>
                    </td>
                    <td data-limit-char="20"><?=$data["InStock"]?></td>
                    <td data-limit-char="20"><?=$data["CatName"]?></td>
                    <td data-limit-char="20">
                        <i class="fa <?=$data["ProductMainImage"] != null ? 'fa-image' : 'fa-times'?>" aria-hidden="true"></i>
                    </td>

                    <td>
                        <a href="<?= BerkaPhp\Helper\Html::action('/products/edit/'.$data['ProductID'])?>">
                            <span class="label label-default">Edit</span>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/products/view/'.$data['ProductID'])?>">
                            <span class="label label-default">View</span>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/products/image/'.$data['ProductID'])?>">
                            <span class="label label-default">
                                 <i class="fa fa-image"></i> Manage images
                            </span>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</div>

