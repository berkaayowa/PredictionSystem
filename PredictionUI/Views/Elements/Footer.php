<?php $contact = \Rep::GetContact()[0]; ?>
<footer id="footer" class="footer color-bg" style="margin-top: 30px;">
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Contact Us</h4>
                    </div>
                    <!-- /.module-heading -->
                    <div class="module-body">
                        <ul class="toggle-footer" style="">
                            <li class="media">
                                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
                                <div class="media-body">
                                    <p><?= $contact['PhysicalAddress']?></p>
                                </div>
                            </li>
                            <li class="media">
                                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                                <div class="media-body">
                                    <p><?= $contact['PrimaryTell']?><br><?= $contact['SecondaryTell']?></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Write to us</h4>
                    </div>
                    <!-- /.module-heading -->
                    <div class="module-body">
                        <ul class="toggle-footer" style="">
                            <li class="media">
                                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                                <div class="media-body"> <span><a href="#"><?= $contact['PrimaryEmail']?></a></span>
                                    <br></div>
                            </li>
                            <li class="media">
                                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-whatsapp fa-stack-1x fa-inverse"></i> </span> </div>
                                <div class="media-body"> <span><a href="#"><?= $contact['Whatsapp']?></a></span> </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>
                <!-- /.col -->
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Corporation</h4>
                    </div>
                    <!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li class="first"><a title="about us" href="/about">About us</a></li>
                            <li><a title="Information" href="/customer/service">Customer Service</a></li>
                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>
                <!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Why Choose Us</h4>
                    </div>
                    <!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li class="first"><a href="/pages/view/shopping-guide" title="About us">Shopping Guide</a></li>
                            <li class=" last"><a href="/contacts" title="Suppliers">Contact Us</a></li>
                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-padding social">
                <ul class="link">
                    <li class="fb pull-left"><a target="_blank" rel="nofollow" href="#" title="Facebook"></a></li>
                    <li class="tw pull-left"><a target="_blank" rel="nofollow" href="#" title="Twitter"></a></li>
                    <li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="#" title="GooglePlus"></a></li>
                    <li class="fa fa-whatsapp pull-left">
                        <a target="_blank" rel="nofollow" href="#" title="Whatsapp"></a>
                    </li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 no-padding">
                <div class="clearfix payment-methods">
                    <ul>
                        <li><img style="border: 5px solid #ececec;border-radius: 4px;width: 300px;" src="/Views/Default/Assets/images/payments/6.png" alt=""></li>
<!--                        <li><img src="/Views/Default/Assets/images/payments/2.png" alt=""></li>-->
<!--                        <li><img src="/Views/Default/Assets/images/payments/3.png" alt=""></li>-->
<!--                        <li><img src="/Views/Default/Assets/images/payments/4.png" alt=""></li>-->
<!--                        <li><img src="/Views/Default/Assets/images/payments/5.png" alt=""></li>-->
                    </ul>
                </div>
                <!-- /.payment-methods -->
            </div>
        </div>
    </div>
</footer>