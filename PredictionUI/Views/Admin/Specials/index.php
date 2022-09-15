<?php $product_promotions = $template_data['product_promotions'] ?>
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class=" mb-3" href="<?= BerkaPhp\Helper\Html::action('/specials/add')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    New Special
                </button>
            </a>
        </div>
    </div>
</div>
<div class="table-responsive">
	<table class="table">
		<thead class="thead-inverse">
			<tr>
				<th style='text-transform: capitalize;'>name</th>
				<th style='text-transform: capitalize;'>description</th>
				<th style='text-transform: capitalize;'>has discount</th>
				<th style='text-transform: capitalize;'>discount</th>
				<th style='text-transform: capitalize;'>start date</th>
				<th style='text-transform: capitalize;'>end date</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
		    <?php if(sizeof($product_promotions) > 0): ?>
			<?php foreach ($product_promotions as $data  ): ?>
				<tr>
					<td data-limit-char="20"><?=$data["PromotionName"]?></td>
					<td data-limit-char="20"><?=$data["PromotionDescription"]?></td>
					<td data-limit-char="20"><?=$data["PromotionHasDiscount"]?></td>
					<td data-limit-char="20"><?=$data["PromotionDiscount"]?></td>
					<td data-limit-char="20"><?=$data["PromotionStartDate"]?></td>
					<td data-limit-char="20"><?=$data["PromotionEndDate"]?></td>
					
					<td>
						<a href="<?= BerkaPhp\Helper\Html::action('/specials/edit/'.$data['PromotionID'])?>">
                            <span class="label label-default">Edit</span>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/specials/delete/'.$data['PromotionID'])?>">
                            <span class="label label-default">Delete</span>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/specials/view/'.$data['PromotionID'])?>">
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

