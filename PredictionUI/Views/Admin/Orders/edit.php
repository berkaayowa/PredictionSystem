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
                    <a  class=" mb-3" href="<?= BerkaPhp\Helper\Html::action('/orders/view/'.$data['OrderID'])?>">
                        <button type="button" class="btn btn-default">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            Full Order Details
                        </button>
                    </a>
                    <a  class=" mb-3" href="<?= BerkaPhp\Helper\Html::action('/orders/edit/'.$data['OrderID'])?>">
                        <button type="button" class="btn btn-default">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            Orders
                        </button>
                    </a>
                    <a  class=" mb-3" href="<?= BerkaPhp\Helper\Html::action('/orders')?>">
                        <button type="button" class="btn btn-default">
                            <i class="fa fa-home" aria-hidden="true"></i>
                         Home
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form class="row" method="POST" action="<?= BerkaPhp\Helper\Html::action('/orders/edit/'.$data['OrderID'])?>" enctype="multipart/form-data">
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label class="info-title" for="OrderTotalAmountDue">Total Amount Due</label>
                    <input type="text" class="form-control" value="<?= $data["OrderTotalAmountDue"]?>" name="OrderTotalAmountDue" id="OrderTotalAmountDue"  placeholder="">
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label class="info-title" for="OrderAmountPaid">Amount Paid</label>
                    <input type="number" class="form-control" value="<?=$data["OrderAmountPaid"]?>" name="OrderAmountPaid" id="OrderAmountPaid" placeholder="">
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label class="info-title" for="RefOrderStatusID">Order Status</label>
                    <input data-select-text="<?= Rep::GetData('order_status', 'StatusID',$data["RefOrderStatusID"])['StatusName']?>" type="text" class="form-control " name="RefOrderStatusID" id="RefOrderStatusID" data-value="StatusID" data-text="StatusName" data-type="OrderStatus" data-select="<?=$data["RefOrderStatusID"]?>">
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label class="info-title" for="Name">Order Date</label>
                    <div class="input-group date" data-date>
                        <input type="text" class="form-control" data-format="YYYY-MM-DD" name="OrderDate" id="OrderDate" value="<?=$data["OrderDate"]?>">
                        <span class="input-group-addon">
                            <span class="fa fa-clock-o"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label class="info-title" for="RefOrderPaymentID">Payment</label>
                    <input data-select-text="<?= Rep::GetData('order_payments', 'PaymentID',$data["RefOrderPaymentID"])['PaymentName']?>" type="text" class="form-control " name="RefOrderPaymentID" id="RefOrderPaymentID" data-value="PaymentID" data-text="PaymentName" data-type="OrderPayments" data-select="<?=$data["RefOrderPaymentID"]?>">
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label class="info-title" for="Title">Payment Date</label>
                    <div class="input-group date" >
                        <input disabled type="text" class="form-control"  name="PaymentDate" id="PaymentDate" value="<?=$data["PaymentDate"]?>">
                        <span class="input-group-addon">
                            <span class="fa fa-clock-o"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label class="info-title" for="NotifyUser">
                        <span class="fa fa-fw fa-bell"></span> Notify customer about the updates ? </label>
                    <input type="checkbox" name="NotifyUser" id="NotifyUser">
                </div>
            </div>

            <div class="col-md-12 col-lg-12">
                <input type="hidden" name="OrderID" value="<?=$data['OrderID']?>">
                <button type="submit" class="btn btn-primary">Update Order</button>
            </div>
        </form>
    </div
</div>
