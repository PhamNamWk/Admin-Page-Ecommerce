    <nav class="sidebar vertical-scroll ps-container ps-theme-default ps-active-y">
        <div class="logo d-flex justify-content-between">
            <a href="index-2.html"><img src={{ file_url('assets/img/logo.png') }} alt /></a>
            <div class="sidebar_close_icon d-lg-none">
                <i class="ti-close"></i>
            </div>
        </div>
        <ul id="sidebar_menu">

            <li>
                <a href="{{ $_ENV['BASE_URL'] . 'dashboard' }}" aria-expanded="false">
                    <div class="icon_menu">
                        <i class="ti-home"></i>
                    </div>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ $_ENV['BASE_URL'] . 'product' }}" aria-expanded="false">
                    <div class="icon_menu">
                        <i class="ti-shopping-cart-full"></i>
                    </div>
                    <span>Product</span>
                </a>
            </li>
            <li>
                <a href="{{ $_ENV['BASE_URL'] . 'category' }}" aria-expanded="false">
                    <div class="icon_menu">
                        <i class="ti-briefcase"></i>
                    </div>
                    <span>Category</span>
                </a>
            </li>
            <li>
                <a href="{{ $_ENV['BASE_URL'] . 'user' }}" aria-expanded="false">
                    <div class="icon_menu">
                        <i class="ti-user"></i>
                    </div>
                    <span>User</span>
                </a>
            </li>
        </ul>
    </nav>
