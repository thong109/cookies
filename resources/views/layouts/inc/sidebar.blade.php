<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Menu</li>
                <li>
                    <a href="{{ route('Dashboard') }}">
                        <i class="fa fa-tachometer"></i>Dashboards
                        <i class="metismenu-state-icon fa fa-angle-left caret-left"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-list-alt"></i>Danh mục
                        <i class="metismenu-state-icon fa fa-angle-left caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('Category') }}">
                                <i class="metismenu-icon"></i> Danh sách danh mục
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('CreateCategory') }}">
                                <i class="metismenu-icon"></i> Thêm danh mục
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-shuffle"></i>Thương hiệu
                        <i class="metismenu-state-icon fa fa-angle-left caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('Brand') }}">
                                <i class="metismenu-icon"></i> Danh sách thương hiệu
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('CreateBrand') }}">
                                <i class="metismenu-icon"></i> Thêm thương hiệu
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-brands fa-product-hunt"></i>Sản phẩm
                        <i class="metismenu-state-icon fa fa-angle-left caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('Product') }}">
                                <i class="metismenu-icon"></i> Danh sách sản phẩm
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('CreateProduct') }}">
                                <i class="metismenu-icon"></i> Thêm sản phẩm
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-percent"></i>Mã giảm giá
                        <i class="metismenu-state-icon fa fa-angle-left caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('Coupon') }}">
                                <i class="metismenu-icon"></i> Danh sách mã giảm giá
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('CreateCoupon') }}">
                                <i class="metismenu-icon"></i>Thêm mã giảm giá
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('Delivery') }}">
                        <i class="fa-solid fa-truck-arrow-right"></i>Quản lý vận chuyển
                        <i class="metismenu-state-icon fa fa-angle-left caret-left"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-user"></i>Quản lý khách hàng
                        <i class="metismenu-state-icon fa fa-angle-left caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('Customer') }}">
                                <i class="metismenu-icon"></i> Danh sách khách hàng
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('CreateCustomer') }}">
                                <i class="metismenu-icon"></i> Tạo tài khoản
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('ManageOrder') }}">
                        <i class="fa-solid fa-bag-shopping"></i>Quản lý đơn hàng
                        <i class="metismenu-state-icon fa fa-angle-left caret-left"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-users"></i>Quản trị viên
                        <i class="metismenu-state-icon fa fa-angle-left caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('Staff') }}">
                                <i class="metismenu-icon"></i> Danh sách quản trị viên
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('CreateStaff') }}">
                                <i class="metismenu-icon"></i> Tạo tài khoản
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-blog"></i>Bài viết
                        <i class="metismenu-state-icon fa fa-angle-left caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('Blogs') }}">
                                <i class="metismenu-icon"></i> Danh sách bài viết
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="metismenu-icon"></i> Thêm bài viết
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
