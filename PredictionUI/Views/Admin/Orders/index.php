<?php $orders = $template_data['orders'] ?>
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class=" mb-3" href="<?= BerkaPhp\Helper\Html::action('/order')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    New Order
                </button>
            </a>
        </div>
    </div>
</div>

<div class="table-responsive">
	<table class="table table-bordered" id="dataTable" width="100%">
		<thead class="thead-inverse">
			<tr class="table-header">
				<th style='text-transform: capitalize;'>user</th>
				<th style='text-transform: capitalize;'>order Number</th>
				<th style='text-transform: capitalize;'>order date</th>
				<th style='text-transform: capitalize;'>total amount due</th>
				<th style='text-transform: capitalize;'>amount paid</th>
				<th style='text-transform: capitalize;'>order status</th>
				<th style='text-transform: capitalize;'>payment</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
		    <?php if(sizeof($orders) > 0): ?>
			<?php foreach ($orders as $data  ): ?>
                    <?php
                    $oderDateTime = new DateTime($data["OrderDate"]);
                    $now = new DateTime();;
                    $time = $oderDateTime->diff($now)->format("%d days, %h hours and %i minuts");
                    $hours = $oderDateTime->diff($now)->format("%h");
                    ?>
				<tr>
					<td data-limit-char="20">
                        <i class="fa fa-user"></i>  <?=$data["Email"]?>
                    </td>
					<td data-limit-char="20">
                        <label class="badge badge-success order-label bg-dark-theme">
                            #<?=$data["OrderCode"]?>
                        </label>
                    </td>
					<td data-limit-char="20">
                        <?= $data["OrderDate"]?>
					</td>
					<td data-limit-char="20">
                        <label class="label label-default order-label bg-dark-theme">
                            R <?=$data["OrderTotalAmountDue"]?>
                        </label>
                    </td>
					<td data-limit-char="20"><?=$data["OrderAmountPaid"]?></td>
					<td data-limit-char="20">
                        <?=$data["StatusName"]?>
                    </td>
					<td data-limit-char="20">
                        <?=$data["RefOrderPaymentID"] == FULL_PAID ? '<label class="badge badge-success order-label">Paid</label>' : '<label class="badge badge-danger order-label">Unpaid</label>'?>
                    </td>
					
					<td>
                        <a href="<?= BerkaPhp\Helper\Html::action('/orders/edit/'.$data['OrderID'])?>">
                            <span class="label label-default">Edit</span>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/orders/view/'.$data['OrderID'])?>">
                            <span class="label label-default">Order Details</span>
                        </a>
                        <a href="<?= BerkaPhp\Helper\Html::action('/orders/view/'.$data['OrderID'])?>">
                            <span class="label label-default">
                                 <i class="fa fa-user"></i> Owner
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

</script>

