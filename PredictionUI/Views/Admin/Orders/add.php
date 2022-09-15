<br/>
<br/>
<br/>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><h3>New order</h3></div>
        <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/orders/add')?>" enctype="multipart/form-data">
        <div class="panel-body">
               
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="OrderID">order i d</label>
        <div class="col-sm-10">
            <input type="number" class="form-control " name="OrderID" id="OrderID" placeholder="order i d">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="RefUserID">ref user i d</label>
        <div class="col-sm-10">
            <input type="number" class="form-control " name="RefUserID" id="RefUserID" placeholder="ref user i d">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="OrderCode">order code</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="OrderCode" id="OrderCode" placeholder="order code">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="OrderDate">order date</label>
        <div class="col-sm-10">
            <div class="input-group date" data-date>
                <input type="text" class="form-control " data-date data-format="YYYY-MM-DD HH:mm" name="OrderDate" id="OrderDate" placeholder="order date">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="OrderTotalAmountDue">order total amount due</label>
        <div class="col-sm-10">
            <input type="number" class="form-control " name="OrderTotalAmountDue" id="OrderTotalAmountDue" placeholder="order total amount due">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="OrderAmountPaid">order amount paid</label>
        <div class="col-sm-10">
            <input type="number" class="form-control " name="OrderAmountPaid" id="OrderAmountPaid" placeholder="order amount paid">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="RefOrderStatusID">ref order status i d</label>
        <div class="col-sm-10">
            <input type="number" class="form-control " name="RefOrderStatusID" id="RefOrderStatusID" placeholder="ref order status i d">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="RefOrderPaymentID">ref order payment i d</label>
        <div class="col-sm-10">
            <input type="number" class="form-control " name="RefOrderPaymentID" id="RefOrderPaymentID" placeholder="ref order payment i d">
        </div>
    </div>
        
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
</div>