<?php $about = $template_data['about'] ?>
<br>
<br>
<div class="table-responsive">
	<table class="table">
		<thead class="thead-inverse">
			<tr>
				<th style='text-transform: capitalize;'>i d</th>
				<th style='text-transform: capitalize;'>title</th>
				<th style='text-transform: capitalize;'>content</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
		    <?php if(sizeof($about) > 0): ?>
			<?php foreach ($about as $data  ): ?>
				<tr>
					<td data-limit-char="20"><?=$data["ID"]?></td>
					<td data-limit-char="20"><?=$data["Title"]?></td>
					<td data-limit-char="20"><?=$data["Content"]?></td>
					
					<td>
						<a href="<?= BerkaPhp\Helper\Html::action('/about/edit/'.$data['ID'])?>">
                            <button type="button" class="btn btn-default">Edite</button>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/about/delete/'.$data['ID'])?>">
                            <button type="button" class="btn btn-default">Delete</button>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/about/view/'.$data['ID'])?>">
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

