<?php $brands = $template_data['brands'] ?>
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class="mb-3" href="<?= BerkaPhp\Helper\Html::action('/brands/add')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    New Brand
                </button>
            </a>
        </div>
    </div>
</div>

<div class="table-responsive">
	<table class="table table-bordered" id="dataTable">
		<thead class="thead-inverse">
			<tr>
				<th style='text-transform: capitalize;'>brand i d</th>
				<th style='text-transform: capitalize;'>brand name</th>
				<th style='text-transform: capitalize;'>brand description</th>

				<th style='text-transform: capitalize;'>active</th>
                <th style='text-transform: capitalize;'>brand logo</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
		    <?php if(sizeof($brands) > 0): ?>
			<?php foreach ($brands as $data  ): ?>
				<tr>
					<td data-limit-char="20"><?=$data["BrandID"]?></td>
					<td data-limit-char="20"><?=$data["BrandName"]?></td>
					<td data-limit-char="20"><?=$data["BrandDescription"]?></td>
					<td data-limit-char="20">
                        <i class="fa <?=$data["IsActive"] == BerkaPhp\Helper\Check::True() ? 'fa-check' : 'fa-times'?>" aria-hidden="true"></i>
                    </td>
                    <td data-limit-char="20">
                        <img src="<?=$data["BrandLogo"] != null ? $data["BrandLogo"] : '/Views/Client/Assets/noimage.png' ?>" width="50px">
                    </td>
					
					<td>
						<a href="<?= BerkaPhp\Helper\Html::action('/brands/edit/'.$data['BrandID'])?>">
                            <button type="button" class="btn btn-default">Edite</button>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/brands/delete/'.$data['BrandID'])?>">
                            <span href="<?= BerkaPhp\Helper\Html::action('/brands/delete/'.$data['BrandID'])?>"  class="label label-default" data-delete="Do you want to delete <?=$data["BrandName"]?>">Delete</span>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/brands/view/'.$data['BrandID'])?>">
                            <button type="button" class="btn btn-default">View</button>
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

