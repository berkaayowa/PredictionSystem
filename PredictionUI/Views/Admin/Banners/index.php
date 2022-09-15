<?php $banners = $template_data['banners'] ?>
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a class=" mb-3" href="<?= BerkaPhp\Helper\Html::action('/banners/add')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    New Banner
                </button>
            </a>
        </div>
    </div>
</div>
<div class="table-responsive">
	<table class="table table-bordered" id="dataTable">
		<thead class="thead-inverse">
			<tr class="table-header">
				<th style='text-transform: capitalize;'>#</th>
				<th style='text-transform: capitalize;'>title</th>
				<th style='text-transform: capitalize;'>description</th>
				<th style='text-transform: capitalize;'>last modified</th>
				<th style='text-transform: capitalize;'>active</th>
                <th style='text-transform: capitalize;'>Image</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
		    <?php if(sizeof($banners) > 0): ?>
			<?php foreach ($banners as $data  ): ?>
				<tr>
					<td data-limit-char="20"><?=$data["ID"]?></td>
					<td data-limit-char="20"><?=$data["Title"]?></td>
					<td data-limit-char="20"><?=BerkaPhp\Helpertr::limitChar($data["Description"], 50, '..')?></td>
					<td data-limit-char="20"><?=$data["LastModified"]?></td>
					<td data-limit-char="20">
                        <i class="fa <?=$data["IsActive"] == BerkaPhp\Helper\Check::True() ? 'fa-check' : 'fa-times'?>" aria-hidden="true"></i>
                    </td>
                    <td data-limit-char="20">
                        <i class="fa <?=$data["Banner"] != null ? 'fa-image' : 'fa-times'?>" aria-hidden="true"></i>
                    </td>
					
					<td>
						<a href="<?= BerkaPhp\Helper\Html::action('/banners/edit/'.$data['ID'])?>">
                            <span class="label label-default">Edit</span>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/banners/view/'.$data['ID'])?>">
                            <span class="label label-default">View</span>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/banners/image/'.$data['ID'])?>">
                            <span class="label label-default">
                                 <i class="fa fa-image"></i> Manage image
                            </span>
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

