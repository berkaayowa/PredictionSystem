
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">
                    <?= Rep::GetNumberOfUnReadMessage()?>
                     Unread Messages!
                </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-list"></i>
                </div>
                <div class="mr-5">11 Enquiries!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5">
                    <?= Rep::GetNumberOfOrdersPaid()?>
                    Orders Paid
                </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" panel="dashboard" data-ajax="/admin/orders/search/?payment=<?=FULL_PAID?>">
                <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5">
                    <?= Rep::GetNumberOfOrdersUnpaid()?>
                    Orders Unpaid
                </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" panel="dashboard" data-ajax="/admin/orders/search/?payment=<?=NOT_PAID?>">
                <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
        </div>
    </div>

<!--    <div class="col-xl-3 col-sm-12 col-md-3 col-lg-3">-->
<!--        <div class="card mb-3">-->
<!--            <div class="card-header">-->
<!--                <i class="fa fa-pie-chart"></i> Pie Chart Example</div>-->
<!--            <div class="card-body">-->
<!--                <canvas id="myPieChart" width="100%" height="100"></canvas>-->
<!--            </div>-->
<!--            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
<!--        </div>-->
<!--    </div>-->

    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12" id="dashboard">
    </div>
</div>