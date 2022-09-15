<?php $product_categories = $template_data['product_categories'] ?>
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class=" mb-3" href="<?= BerkaPhp\Helper\Html::action('/categories/add')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    New Category
                </button>
            </a>
        </div>
    </div>
</div>
<div class="table-responsive">
	<table class="table table-bordered" id="dataTable">
		<thead class="thead-inverse">
			<tr class="table-header">
				<th style='text-transform: capitalize;'>cat name</th>
				<th style='text-transform: capitalize;'>cat description</th>
				<th style='text-transform: capitalize;'>cat icon</th>
				<th style='text-transform: capitalize;'>cat order</th>
				<th style='text-transform: capitalize;'>active</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
		    <?php if(sizeof($product_categories) > 0): ?>
			<?php foreach ($product_categories as $data  ): ?>
				<tr>
					<td data-limit-char="20"><?=$data["CatName"]?></td>
					<td data-limit-char="20"><?=$data["CatDescription"]?></td>
					<td data-limit-char="20"><?=$data["CatIcon"]?></td>
					<td data-limit-char="20"><?=$data["CatOrder"]?></td>
					<td data-limit-char="20">
                        <i class="fa <?=$data["IsActive"] == BerkaPhp\Helper\Check::True() ? 'fa-check' : 'fa-times'?>" aria-hidden="true"></i>
                    </td>
					
					<td>
						<a href="<?= BerkaPhp\Helper\Html::action('/categories/edit/'.$data['CatID'])?>">
                            <span class="label label-default">Edit</span>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/categories/delete/'.$data['CatID'])?>">
                            <span class="label label-default">Delete</span>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/categories/view/'.$data['CatID'])?>">
                            <span class="label label-default">View</span>
                        </a>
					</td>
				</tr>
			<?php endforeach ?>
			<?php endif ?>
		</tbody>
	</table>
</div>
<script>
	$app.initList(); 
</script>

