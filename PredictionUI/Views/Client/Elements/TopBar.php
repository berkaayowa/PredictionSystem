<div class="header-top-inner">
    <div class="cnt-account">
        <ul class="list-unstyled">
            <li class="dropdown dropdown-small">
                <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" title="Currency">
                    <i class="icon fa fa-money"></i>
                    <span class="value" style="font-weight: bold;">
                        <?= BerkaPhp\HelperCurrency::getCurrentCurrency() ?>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li><a data-update-currency="ZAR">ZAR</a></li>
                    <li><a data-update-currency="USD">USD</a></li>
                    <li><a data-update-currency="EUR">EUR</a></li>
                </ul>
            </li>
            <li class="dropdown dropdown-small">
                <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" title="language">
                    <i class="icon fa fa-globe"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a data-update-currency="ZAR">English</a></li>
                    <li><a data-update-currency="USD">French</a></li>
                </ul>
            </li>
            <li><a href="/shopping/cart" title="My Cart"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
            <?php if (!BerkaPhp\Helper\Auth::IsUserLogged()) :?>
                <li><a href="/users/signin"><i class="icon fa fa-sign-in"></i> Sign in | Sign up</a></li>
            <?php else: ?>

                <li>
                    <a href="/orders" title="My Orders">
                        <i class="icon fa fa-shopping-bag"></i>
                        My Oders
                    </a>
                </li>
                <li>
                    <a href="/users/profile" title="Profile">
                        <i class="icon fa fa-user"></i>
                        Hi <?= ucfirst(BerkaPhp\Helper\Auth::GetActiveUser(false, 'FirstName'))?>
                    </a>
                </li>
                <li>
                    <a href="/users/logout" title="logout">
                        <i class="icon fa fa-sign-out"></i>
                        logout
                    </a>
                </li>
            <?php endif; ?>

            <?php if (BerkaPhp\Helper\Auth::IsUseRole(ADMIN, false, '', 'UserRoleID') || BerkaPhp\Helper\Auth::IsUseRole(DEVELOPER, false, '', 'UserRoleID')) :?>
                <li> <a href="/admin/pages/dashboard" title="Admin panel"><i class="icon fa fa-cogs"></i> Admin panel</a></li>
            <?php endif; ?>

        </ul>
    </div>

    <div class="cnt-block">
        
    </div>
</div>