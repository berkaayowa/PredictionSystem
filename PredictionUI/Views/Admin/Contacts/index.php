<?php $contacts = $template_data['contacts'] ?>
<br>
<br>
<div class="table-responsive">
	<table class="table">
		<thead class="thead-inverse">
			<tr>
				<th style='text-transform: capitalize;'>i d</th>
				<th style='text-transform: capitalize;'>primary email</th>
				<th style='text-transform: capitalize;'>secondary email</th>
				<th style='text-transform: capitalize;'>primary tell</th>
				<th style='text-transform: capitalize;'>secondary tell</th>
				<th style='text-transform: capitalize;'>fax</th>
				<th style='text-transform: capitalize;'>physical address</th>
				<th style='text-transform: capitalize;'>facebook</th>
				<th style='text-transform: capitalize;'>twitter</th>
				<th style='text-transform: capitalize;'>map longitude</th>
				<th style='text-transform: capitalize;'>maplatitude</th>
				<th style='text-transform: capitalize;'>google map</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
		    <?php if(sizeof($contacts) > 0): ?>
			<?php foreach ($contacts as $data  ): ?>
				<tr>
					<td data-limit-char="20"><?=$data["ID"]?></td>
					<td data-limit-char="20"><?=$data["PrimaryEmail"]?></td>
					<td data-limit-char="20"><?=$data["SecondaryEmail"]?></td>
					<td data-limit-char="20"><?=$data["PrimaryTell"]?></td>
					<td data-limit-char="20"><?=$data["SecondaryTell"]?></td>
					<td data-limit-char="20"><?=$data["Fax"]?></td>
					<td data-limit-char="20"><?=$data["PhysicalAddress"]?></td>
					<td data-limit-char="20"><?=$data["Facebook"]?></td>
					<td data-limit-char="20"><?=$data["Twitter"]?></td>
					<td data-limit-char="20"><?=$data["MapLongitude"]?></td>
					<td data-limit-char="20"><?=$data["Maplatitude"]?></td>
					<td data-limit-char="20"><?=$data["GoogleMap"]?></td>
					
					<td>
						<a href="<?= BerkaPhp\Helper\Html::action('/contacts/edit/'.$data['ID'])?>">
                            <button type="button" class="btn btn-default">Edite</button>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/contacts/delete/'.$data['ID'])?>">
                            <button type="button" class="btn btn-default">Delete</button>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/contacts/view/'.$data['ID'])?>">
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

