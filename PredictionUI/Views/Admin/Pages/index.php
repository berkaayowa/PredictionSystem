<?php $pages = $template_data['pages'] ?>
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class="mb-3" href="<?= BerkaPhp\Helper\Html::action('/pages/add')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    New Page
                </button>
            </a>
        </div>
    </div>
</div>
<div class="table-responsive">
	<table class="table table-bordered" id="dataTable">
		<thead class="thead-inverse">
			<tr class="table-header">
				<th style='text-transform: capitalize;'>title</th>
				<th style='text-transform: capitalize;'>created date</th>
				<th style='text-transform: capitalize;'>last modified</th>
				<th style='text-transform: capitalize;'>visible</th>
				<th style='text-transform: capitalize;'>link</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
		    <?php if(sizeof($pages) > 0): ?>
			<?php foreach ($pages as $data  ): ?>
				<tr>
					<td data-limit-char="20"><?=BerkaPhp\Helpertr::limitChar($data["Title"], 20, '..') ?></td>
					<td data-limit-char="20"><?=$data["CreatedDate"]?></td>
					<td data-limit-char="20"><?=$data["LastModified"]?></td>
					<td data-limit-char="20">
                        <i class="fa <?=$data["IsVisible"] == BerkaPhp\Helper\Check::True() ? 'fa-check' : 'fa-times'?>" aria-hidden="true"></i>
                    </td>
					<td data-limit-char="20"><?=$data["Link"]?></td>
					<td>
						<a href="<?= BerkaPhp\Helper\Html::action('/pages/edit/'.$data['ID'])?>">
                            <span class="label label-default">Edit</span>
						</a>

                        <a href="<?= BerkaPhp\Helper\Html::action('/pages/delete/'.$data['ID'])?>" data-delete="Do you want to delete <?=$data["Title"]?>">
                            <span href="<?= BerkaPhp\Helper\Html::action('/pages/delete/'.$data['ID'])?>" class="label label-default">Delete</span>
                        </a>

						<a target="_blank" href="/pages/preview/<?=$data['ID']?>">
                            <span class="label label-default">View</span>
						</a>
					</td>
				</tr>
			<?php endforeach ?>
			<?php endif ?>
		</tbody>
	</table>
</div>
