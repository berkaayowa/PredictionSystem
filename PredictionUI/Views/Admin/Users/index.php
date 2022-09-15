<?php $users = $template_data['users'] ?>
<div class="row text-right">
	<div class="col-sm-12 col-md-12 col-lg-12 ">
		<div class="btn-group">
			<a  class="mb-3" href="<?= BerkaPhp\Helper\Html::action('/users/add')?>">
				<button type="button" class="btn btn-default">
					<i class="fa fa-plus-circle" aria-hidden="true"></i>
					New User
				</button>
			</a>
		</div>
	</div>
</div>

<div class="table-responsive">
	<table class="table table-bordered" id="dataTable">
		<thead class="thead-inverse">
			<tr class="table-header">
				<th style='text-transform: capitalize;'>last name</th>
				<th style='text-transform: capitalize;'>first name</th>
				<th style='text-transform: capitalize;'>user Right</th>
				<th style='text-transform: capitalize;'>phone</th>
				<th style='text-transform: capitalize;'>email</th>
				<th style='text-transform: capitalize;'>is verified</th>
				<th style='text-transform: capitalize;'>can log in</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
		    <?php if(sizeof($users) > 0): ?>
			<?php foreach ($users as $data  ): ?>
				<tr>
					<td data-limit-char="20"><?=$data["LastName"]?></td>
					<td data-limit-char="20"><?=$data["FirstName"]?></td>
					<td data-limit-char="20"><?=$data["Name"]?></td>
					<td data-limit-char="20"><?=$data["Phone"]?></td>
					<td data-limit-char="20"><?=$data["Email"]?></td>
					<td data-limit-char="20">
						<?php if($data["IsVerified"] == BerkaPhp\Helper\Check::True()): ?>
							<label class="badge badge-success order-label">
								<i class="fa fa-check" aria-hidden="true"></i>
							</label>
						<?php endif ?>
						<?php if($data["IsVerified"] == BerkaPhp\Helper\Check::False()): ?>
							<label class="badge badge-danger order-label">
								<i class="fa fa-times" aria-hidden="true"></i>
							</label>
						<?php endif ?>
					</td>
					<td data-limit-char="20">
						<?php if($data["CanLogIn"] == BerkaPhp\Helper\Check::True()): ?>
							<label class="badge badge-success order-label">
								<i class="fa fa-check" aria-hidden="true"></i>
							</label>
						<?php endif ?>
						<?php if($data["CanLogIn"] == BerkaPhp\Helper\Check::False()): ?>
							<label class="badge badge-danger order-label">
								<i class="fa fa-times" aria-hidden="true"></i>
							</label>
						<?php endif ?>
					</td>
					
					<td>
						<a href="<?= BerkaPhp\Helper\Html::action('/users/view/'.$data['UserID'])?>">
							<span class="label label-default">View</span>
						</a>

						<?php if($data['UserRoleID'] == CUSTOMER &&  BerkaPhp\Helper\Auth::GetActiveUser(true, "UserRoleID") == STUFF) :?>
							<a href="<?= BerkaPhp\Helper\Html::action('/users/edit/'.$data['UserID'])?>" data-delete="Do you want to edit <?=$data["LastName"]?>" data-title="Editing user">
								<span href="<?= BerkaPhp\Helper\Html::action('/users/edit/'.$data['UserID'])?>" class="label label-default">Edit</span>
							</a>
						<?php elseif(in_array($data['UserRoleID'], [CUSTOMER, STUFF]) &&  BerkaPhp\Helper\Auth::GetActiveUser(true, "UserRoleID") == ADMIN):?>
							<a href="<?= BerkaPhp\Helper\Html::action('/users/edit/'.$data['UserID'])?>" data-delete="Do you want to edit <?=$data["LastName"]?>" data-title="Editing user">
								<span href="<?= BerkaPhp\Helper\Html::action('/users/edit/'.$data['UserID'])?>" class="label label-default">Edit</span>
							</a>
						<?php elseif(in_array($data['UserRoleID'], [CUSTOMER, STUFF, ADMIN, DEVELOPER]) &&  BerkaPhp\Helper\Auth::GetActiveUser(true, "UserRoleID") == DEVELOPER):?>
							<a href="<?= BerkaPhp\Helper\Html::action('/users/edit/'.$data['UserID'])?>" data-delete="Do you want to edit <?=$data["LastName"]?>" data-title="Editing user">
								<span href="<?= BerkaPhp\Helper\Html::action('/users/edit/'.$data['UserID'])?>" class="label label-default">Edit</span>
							</a>
						<?php endif ?>


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

