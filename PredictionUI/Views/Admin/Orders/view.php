<?php $data = $template_data['order'][0]; ?>

<div class="row ">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="row">
            <div class="text-left col-md-6">
                <h3 class="heading-title">
                    Order Number: #<?=$data["OrderCode"]?>
                </h3>
            </div>
            <div class="text-right col-md-6">
                <div class="btn-group">
                    <a  class=" mb-3" href="<?= BerkaPhp\Helper\Html::action('/orders/edit/'.$data['OrderID'])?>">
                        <button type="button" class="btn btn-default">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                             Update This Order
                        </button>
                    </a>
                    <a  class=" mb-3" href="<?= BerkaPhp\Helper\Html::action('/orders')?>">
                        <button type="button" class="btn btn-default">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            Orders
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <form class="row" id="contact-form" role="form">
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label class="info-title" for="Name">Total Amount Due</label>
                    <input type="text" disabled class="form-control unicase-form-control text-input" value="<?= $data["OrderTotalAmountDue"]?>" name="Name" id="Name"  placeholder="">
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label class="info-title" for="Email">Amount Paid</label>
                    <input type="text" disabled class="form-control unicase-form-control text-input" value="<?=$data["OrderAmountPaid"]?>" name="Email" id="Email" placeholder="">
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label class="info-title" for="Title">Order Status</label>
                    <input type="text" disabled class="form-control unicase-form-control text-input" value="<?=$data["StatusName"]?>" name="Title" id="Title" placeholder="">
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label class="info-title" for="Name">Order Date</label>
                    <input type="text" disabled class="form-control unicase-form-control text-input" value="<?= $data["OrderDate"]?>" name="Name" id="Name"  placeholder="">
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label class="info-title" for="Email">Payment</label>
                    <input type="text" disabled class="form-control unicase-form-control text-input" value="<?=$data["PaymentName"]?>" name="Email" id="Email" placeholder="">
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label class="info-title" for="Title">Payment Date</label>
                    <input type="text" disabled class="form-control unicase-form-control text-input" value="<?=$data["PaymentDate"]?>" name="Title" id="Title" placeholder="">
                </div>
            </div>
        </form>

        <hr/>
        <h3 class="heading-title">
            Client Details
        </h3>
        <hr/>

        <form class="row" id="contact-form" role="form">
            <div class="col-md-4 col-lg-4">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                            <label class="info-title" for="Name">Full name</label>
                            <input type="text" disabled class="form-control unicase-form-control text-input" value="<?= $data["FirstName"]?> <?= $data["LastName"]?>" name="Name" id="Name"  placeholder="">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                            <label class="info-title" for="Name">Contacts</label>
                            <input type="text" disabled class="form-control unicase-form-control text-input" value="<?= $data["Email"]?> <?= !empty($data["Phone"]) ?','.$data["Phone"] : ''?>" name="Name" id="Name"  placeholder="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                    <label class="info-title" for="Email">Delivery Address</label>
                    <textarea disabled class="form-control unicase-form-control text-input" rows="5" id="Email" placeholder=""><?=$deliveryAddress['FullAddress']?></textarea>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                    <label class="info-title" for="Email">Delivery Area</label>
                    <?php
                   // die(''.$data['RefDeliveryID']);
                    $element = BerkaPhp\Helper\Html::select('', 'RefDeliveryID', $deliveryInfo, ['class'=>'form-control', 'selected'=> $data['RefDeliveryID'], 'value'=>'DeliveryID', 'text'=>'Name','disabled'=>"true"]);
                    echo $element;
                    ?>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <hr/>
                <h3 class="heading-title">
                    Order Items
                </h3>
                <hr/>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%">
                        <thead class="thead-inverse">
                        <tr class="table-header">
                            <th style='text-transform: capitalize;'>name</th>
                            <th style='text-transform: capitalize;'>Category </th>
                            <th style='text-transform: capitalize;'>price</th>
                            <th style='text-transform: capitalize;'>quantity</th>
                            <th style='text-transform: capitalize;'>image</th>
                            <th style='text-transform: capitalize;'>options</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(sizeof($template_data['items']) > 0): ?>
                            <?php foreach ($template_data['items'] as $data  ): ?>
                                <tr>
                                    <td data-limit-char="20"><?=$data["ProductShortName"]?></td>
                                    <td data-limit-char="20"><?=$data["CatName"]?></td>
                                    <td data-limit-char="20"><?= BerkaPhp\HelperCurrency::Init($data["ProductPrice"])->toString()?></td>
                                    <td data-limit-char="20"><?=$data["ItemQuantity"]?></td>
                                    <td data-limit-char="20">
                                        <img src="<?=$data["ProductMainImage"] != null ? $data["ProductMainImage"] : '/Views/Client/Assets/noimage.png' ?>" width="50px">
                                    </td>
                                    <td>
                                        <a href="<?= BerkaPhp\Helper\Html::action('/products/view/'.$data['ProductID'])?>">
                                            <span class="label label-default">
<!--                                                <i class="fa fa-eye" aria-hidden="true"></i> -->
                                                 More Details
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
