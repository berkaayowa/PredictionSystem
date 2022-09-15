<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a target="_blank" class="navbar-brand" href="/">
        <img class="logo-img" src="<?=SECOND_LOGO?>">
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="<?= BerkaPhp\Helper\Html::action('/pages/dashboard')?>">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-file"></i>
                    <span class="nav-link-text">Pages</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseComponents">
                    <li>
                        <a href="<?= BerkaPhp\Helper\Html::action('/customer/service')?>">
                            Customer Service
                        </a>
                    </li>
                    <li>
                        <a href="<?= BerkaPhp\Helper\Html::action('/about/terms')?>">
                            Terms & conditions
                        </a>
                    </li>
                    <li>
                        <a href="<?= BerkaPhp\Helper\Html::action('/pages')?>">
                            Other Pages
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Banners">
                <a class="nav-link" href="<?= BerkaPhp\Helper\Html::action('/banners')?>">
                    <i class="fa fa-fw fa-photo"></i>
                    <span class="nav-link-text">Banners</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="About us">
                <a class="nav-link" href="<?= BerkaPhp\Helper\Html::action('/about/edit/1')?>">
                    <i class="fa fa-fw fa-file"></i>
                    <span class="nav-link-text">About us</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Contacts">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponentsCon" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-phone"></i>
                    <span class="nav-link-text">Contacts</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseComponentsCon">
                    <li>
                        <a href="<?= BerkaPhp\Helper\Html::action('/contacts/social')?>">
                            Social Media
                        </a>
                    </li>
                    <li>
                        <a href="<?= BerkaPhp\Helper\Html::action('/contacts/other')?>">
                            Other info
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Help center">
                <a class="nav-link" href="<?= BerkaPhp\Helper\Html::action('/pages/help')?>">
                    <i class="fa fa-fw fa-info"></i>
                    <span class="nav-link-text">Help center</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Shopping guide">
                <a class="nav-link" href="<?= BerkaPhp\Helper\Html::action('/pages/shoppingguide')?>">
                    <i class="fa fa-fw fa-shopping-bag"></i>
                    <span class="nav-link-text">Shopping guide</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                <hr/>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Products">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#product" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-laptop"></i>
                    <span class="nav-link-text">Products</span>
                </a>
                <ul class="sidenav-second-level collapse" id="product">
                    <li>
                        <a href="<?= BerkaPhp\Helper\Html::action('/products')?>">
                            Product List
                        </a>
                    </li>
                    <li>
                        <a href="<?= BerkaPhp\Helper\Html::action('/categories')?>">
                            Category
                        </a>
                    </li>
                    <li>
                        <a href="<?= BerkaPhp\Helper\Html::action('/brands')?>">
                            Brands
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Orders">
                <a class="nav-link" href="<?= BerkaPhp\Helper\Html::action('/orders')?>">
                    <i class="fa fa-fw fa-cart-arrow-down"></i>
                    <span class="nav-link-text">Orders</span>
                </a>
            </li>
            <?php if(BerkaPhp\Helper\Auth::GetActiveUser(false,'UserRoleID') == DEVELOPER) : ?>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Specials">
                <a class="nav-link" href="<?= BerkaPhp\Helper\Html::action('/specials')?>">
                    <i class="fa fa-fw fa-shopping-bag"></i>
                    <span class="nav-link-text">Specials</span>
                </a>
            </li>
            <?php endif?>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                <hr/>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
                <a class="nav-link" href="<?= BerkaPhp\Helper\Html::action('/users')?>">
                    <i class="fa fa-fw fa-user"></i>
                    <span class="nav-link-text">Manage Users</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-envelope"></i>
                    <span class="d-lg-none">Messages
                      <span class="badge badge-pill badge-primary">12 New</span>
                    </span>
                    <span class="indicator text-primary d-none d-lg-block">
                        <i class="fa fa-fw fa-circle"></i>
                    </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">New Messages:</h6>
                    <div class="dropdown-divider"></div>
<!--                    <a class="dropdown-item" href="#">-->
<!--                        <strong>David Miller</strong>-->
<!--                        <span class="small float-right text-muted">11:21 AM</span>-->
<!--                        <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome!</div>-->
<!--                    </a>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item" href="#">-->
<!--                        <strong>Jane Smith</strong>-->
<!--                        <span class="small float-right text-muted">11:21 AM</span>-->
<!--                        <div class="dropdown-message small">I was wondering if you could meet for an appointment </div>-->
<!--                    </a>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item" href="#">-->
<!--                        <strong>John Doe</strong>-->
<!--                        <span class="small float-right text-muted">11:21 AM</span>-->
<!--                        <div class="dropdown-message small">I've sent the final files over to you for review.</div>-->
<!--                    </a>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item small" href="#">View all messages</a>-->
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="alertsDropdown">
<!--                    <h6 class="dropdown-header">New Alerts:</h6>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item" href="#">-->
<!--              <span class="text-success">-->
<!--                <strong>-->
<!--                    <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>-->
<!--              </span>-->
<!--                        <span class="small float-right text-muted">11:21 AM</span>-->
<!--                        <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>-->
<!--                    </a>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item" href="#">-->
<!--              <span class="text-danger">-->
<!--                <strong>-->
<!--                    <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>-->
<!--              </span>-->
<!--                        <span class="small float-right text-muted">11:21 AM</span>-->
<!--                        <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>-->
<!--                    </a>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item" href="#">-->
<!--              <span class="text-success">-->
<!--                <strong>-->
<!--                    <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>-->
<!--              </span>-->
<!--                        <span class="small float-right text-muted">11:21 AM</span>-->
<!--                        <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>-->
<!--                    </a>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item small" href="#">View all alerts</a>-->
                </div>
            </li>
            <li class="nav-item">

            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/users/profile">
                    <i class="fa fa-fw fa-user"></i>
                    <?= ucfirst(\BerkaPhp\Helper\Auth::GetActiveUser(true, 'FirstName'))?>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/users/logout">
                    <i class="fa fa-fw fa-sign-out"></i>Logout
                </a>
            </li>
        </ul>
    </div>
</nav>