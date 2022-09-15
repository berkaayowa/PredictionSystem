<?php $user_roles = $template_data['user_roles'] ?>
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class=" mb-3" href="<?= BerkaPhp\Helper\Html::action('/roles/add')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    New Role
                </button>
            </a>
        </div>
    </div>
</div>
<div class="table-responsive">
	<table class="table">
		<thead class="thead-inverse">
			<tr>
				<th style='text-transform: capitalize;'>i d</th>
				<th style='text-transform: capitalize;'>name</th>
				<th style='text-transform: capitalize;'>description</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
		    <?php if(sizeof($user_roles) > 0): ?>
			<?php foreach ($user_roles as $data  ): ?>
				<tr>
					<td data-limit-char="20"><?=$data["ID"]?></td>
					<td data-limit-char="20"><?=$data["Name"]?></td>
					<td data-limit-char="20"><?=$data["Description"]?></td>
					
					<td>
						<a href="<?= BerkaPhp\Helper\Html::action('/roles/edit/'.$data['ID'])?>">
                            <button type="button" class="btn btn-default">Edite</button>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/roles/delete/'.$data['ID'])?>">
                            <button type="button" class="btn btn-default">Delete</button>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/roles/view/'.$data['ID'])?>">
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

