<div class="se-pre-con"></div>
<div id="PageContainer"></div>
<div class="quick-view"></div>
<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
    <div class="gf-menu-device-wrapper">
        <div class="close-menu">x</div>
        <div class="gf-menu-device-container"></div>
    </div>
</nav>
<div id="shopify-section-top-bar" class="shopify-section">
    <div class="top_bar top-bar-type-10">
        <div class="container">
            <ul class="top_bar_left">
                <li><i class="fa fa-phone"></i> 0000 - 123 - 456789</li>
                <li><i class="fa fa-envelope"></i> <a href="mailto:info@example.com"> info@example.com</a></li>
            </ul>
            <ul class="top_bar_right">
                <li><a href="{{ URL::to('language', ['vi']) }}" class="menu-link sub-menu-link">VietNam</a></li>
                <li><a href="{{ URL::to('language', ['us']) }}" class="menu-link sub-menu-link">English</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="wrapper-container">
    <div class="header-type-10">
        {{-- <div id="SearchDrawer" class="search-bar drawer drawer--top search-bar-type-3">
            <div class="search-bar__table">
                <form action="https://cookie-crumble-01.myshopify.com/search" method="get"
                    class="search-bar__table-cell search-bar__form" role="search">
                    <input type="hidden" name="type" value="product">
                    <div class="search-bar__table">
                        <div class="search-bar__table-cell search-bar__icon-cell">
                            <button type="submit" class="search-bar__icon-button search-bar__submit">
                                <span aria-hidden="true"><i class="fa-solid fa-magnifying-glass"></i></span>
                            </button>
                        </div>
                        <div class="search-bar__table-cell">
                            <input type="search" id="SearchInput" name="q" value="" placeholder="Search..."
                                aria-label="Search..." class="search-bar__input">
                        </div>
                    </div>
                </form>
                <div class="search-bar__table-cell text-right">
                    <button type="button" class="search-bar__icon-button search-bar__close js-drawer-close">
                        <span class="fa fa-times" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div> --}}
        <header class="site-header">
            <div class="header-sticky">
                <div id="header-landing" class="sticky-animate">
                    <div id="shopify-section-header-model-4" class="shopify-section">
                        <div class="grid--full site-header__menubar">
                            <div class="container">
                                <div class="menubar_inner">
                                    <script type="text/javascript">
                                        $(".header-all--collections ul").on("click", ".init", function() {
                                            $(this).closest(".header-all--collections ul").children('li:not(.init)').toggle();
                                        });

                                        var allOptions = $(".header-all--collections ul").children('li:not(.init)');
                                        $(".header-all--collections ul").on("click", "li:not(.init)", function() {
                                            allOptions.removeClass('selected');
                                            $(this).addClass('selected');
                                            $(".header-all--collections ul").children('.init').html($(this).html());
                                            allOptions.toggle();
                                        });
                                        $('.init').click(function() {
                                            if ($('.init').hasClass('active')) {
                                                $(this).removeClass('active'); //.addClass('blue');
                                            } else {
                                                $(this).addClass('active'); //.addClass('red');
                                            }
                                        });
                                    </script>
                                    <div class="slidersearch search-categories order-header">
                                        {{-- <div class="search-categories-section">
                                            <div class="header-search">
                                                <div class="header-search">
                                                    <a href="https://cookie-crumble-01.myshopify.com/search"
                                                        class="site-header__link site-header__search js-drawer-open-top">
                                                        <span aria-hidden="true"><i
                                                                class="fa-solid fa-magnifying-glass"></i></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="customer_account {{ Session::get('customer_id') ? 'd-none' : '' }}">
                                            <div class="header-account_links">
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('Login') }}" title="{{ __('Log in') }}"><i
                                                                class="fa-solid fa-user"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div
                                            class="customer_account {{ Session::get('customer_id') ? 'd-block' : 'd-none' }}">
                                            <div class="header-account_links">
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('Account') }}" title="{{ __('Account') }}">
                                                            <i class="fa-solid fa-user"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="header_top order-header">
                                        <h1 class="site-header__logo" itemscope
                                            itemtype="http://schema.org/Organization">
                                            <a href="{{ route('Home') }}" style="max-width: 170px;">
                                                <img class="normal-logo"
                                                    src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/logo.png?v=56781279899010714441538730560"
                                                    alt="Cookie Crumble | Shopify Theme" itemprop="logo">
                                            </a>
                                        </h1>
                                    </div>
                                    <ul class="menu_bar_right">
                                        <li class="header-mobile">
                                            <div class="menu-block visible-phone">
                                                <!-- start Navigation Mobile  -->
                                                <div id="showLeftPush">
                                                    <i class="icon-menu icons" aria-hidden="true"> </i>
                                                </div>
                                            </div>
                                            <!-- end Navigation Mobile  -->
                                        </li>
                                        {{-- <li class="header-search wide--hide post-large--hide large--hide">
                                            <div class="header_toggle"><span class="zmdi zmdi-search"></span>
                                            </div>
                                            <div class="slidersearch">
                                                <form action="https://cookie-crumble-01.myshopify.com/search"
                                                    method="get" class="search-bar__table-cell search-bar__form"
                                                    role="search">
                                                    <input type="hidden" name="type" value="product">
                                                    <input type="text" id="search" name="q"
                                                        value="" placeholder="Search..." aria-label="Search..."
                                                        class="search-bar__input sb-search-input">
                                                    <button class="sb-search-submit res_btn" type="submit"
                                                        value=""><i class="icon-magnifier"></i></button>
                                                </form>
                                            </div>
                                        </li> --}}
                                        <li
                                            class="customer_account wide--hide post-large--hide large--hide {{ Session::get('customer_id') ? 'd-none' : '' }}">
                                            <div class="header-account_links">
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('Login') }}" title="Log in"><i
                                                                class="icon-user icons"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="wishlist">
                                            <a href="{{ route('Wishlist') }}" title="Wishlist"><i
                                                    class="fa-solid fa-heart"></i></a>
                                        </li>
                                        <li class="header-bar__module cart header_cart">
                                            <!-- Mini Cart Start -->
                                            <div class="baskettop">
                                                <div class="wrapper-top-cart">
                                                    <a href="javascript:void(0)" id="ToggleDown"
                                                        class="icon-cart-arrow">
                                                        <i class="fa-solid fa-bag-shopping"></i>
                                                        <div class="detail">
                                                            <div id="cartCount">
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div id="slidedown-cart" style="display:none">
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="shopify-section-navigation" class="shopify-section">
                        <div class="desktop-megamenu">
                            <div class="nav-bar-mobile">
                                <nav class="nav-bar" role="navigation">
                                    <div class="site-nav-dropdown_inner grid__item menubar-section">
                                        <div class="menu-tool">
                                            <ul class="site-nav">
                                                <li class="">
                                                    <a href="{{ route('Home') }}" class="current">
                                                        <span>
                                                            {{ __('Home') }}
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class=" ">
                                                    <a href="{{ route('Products') }}" class="">
                                                        <span>
                                                            {{ __('Products') }}
                                                        </span>
                                                    </a>
                                                </li>
                                                {{-- <li class=" ">
                                                    <a href="collections/ice-cream.html" class="">
                                                        <span>
                                                            Recipes
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class=" ">
                                                    <a href="collections/ice-cream.html" class="">
                                                        <span>
                                                            Shop
                                                        </span>
                                                    </a>
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
</div>
