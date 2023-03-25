@extends('layouts.app')
@section('title', $getCategoryBySlug['name'] . ' - Cookie Crumble')
@section('body')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <h1>{{ $getCategoryBySlug['name'] }}</h1>
        <a href="{{ route('/') }}" title="Back to the frontpage">Home</a>
        <span aria-hidden="true" class="breadcrumb__sep">/</span>
        <span>{{ $getCategoryBySlug['name'] }}</span>
    </nav>
    <main class="main-content">
        <div class="dt-sc-hr-invisible-large"></div>
        <div class="wrapper">
            <div class="grid__item">
                <div class="grid__item">
                    <div class="collection-products">
                        <div class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter left-sidebar">
                            <!-- /snippets/collection-sidebar.liquid -->
                            <div class="collection_sidebar">
                                <div id="shopify-section-sidebar-category" class="shopify-section">
                                    <div data-section-id="sidebar-category" data-section-type="Sidebar-category">
                                        <div class="widget widget_product_categories">
                                            <h4>Category</h4>
                                            <ul class="product-categories dt-sc-toggle-frame-set">
                                                @foreach ($categories as $category)
                                                    <li class="cat-item cat-item-39 cat-parent first">
                                                        <i></i>
                                                        <a href="{{ route('Collection', ['slug' => $category->slug]) }}"
                                                            class="dt-sc-toggle  active">{{ $category->name }}</a>
                                                        @if (count($category->products()->get()) > 0)
                                                            <ul class="children dt-sc-toggle-content"
                                                                style="overflow: hidden; display: none; padding: 0px 0px 0px 15px;">
                                                                @foreach ($category->products()->get() as $product)
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('HomeProduct', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <span class="dt-menu-expand dt-mean-clicked">-</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="refined-widgets">
                                    <a href="javascript:void(0)" class="clear-all" style="display:none">
                                        Clear All
                                    </a>
                                </div>
                                <div class="sidebar-block">
                                    <div id="shopify-section-sidebar-colors" class="shopify-section">
                                        <aside class="sidebar-tag filter color tags">
                                            <div class="widget">
                                                <h4>
                                                    Shop By Color
                                                    <a href="javascript:void(0)" class="clear" style="display:none">
                                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="widget-content">
                                                <ul>
                                                    <li class="yellow">
                                                        <input type="checkbox" value="yellow" />
                                                        <a href="javascript:void(0)" title="Yellow">
                                                            <img src="https://cdn.shopify.com/s/files/1/2159/5497/files/yellow_50x.png?v=1613540859"
                                                                alt="Yellow" />
                                                            <span>Yellow</span>
                                                        </a>
                                                    </li>
                                                    <li class="cream">

                                                        <input type="checkbox" value="cream" />
                                                        <a href="javascript:void(0)" title="Cream">
                                                            <img src="https://cdn.shopify.com/s/files/1/2159/5497/files/cream_50x.png?v=1613540859"
                                                                alt="Cream" />
                                                            <span>Cream</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </aside>
                                    </div>
                                    <div id="shopify-section-sidebar-tag-filters" class="shopify-section">
                                        <aside class="sidebar-tag filter tags size shop by brand 1477476983857">

                                            <div class="widget">
                                                <h4>
                                                    Shop By Brand
                                                    <a href="javascript:void(0)" class="clear" style="display:none">
                                                        <i class="icon-close" aria-hidden="true"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="widget-content">
                                                <ul>
                                                    <li>
                                                        <i></i>
                                                        <input type="checkbox" value="biscoff" />
                                                        <label>Biscoff</label>
                                                    </li>
                                                    <li>
                                                        <i></i>
                                                        <input type="checkbox" value="chillium" />
                                                        <label>Chillium</label>
                                                    </li>
                                                    <li>
                                                        <i></i>
                                                        <input type="checkbox" value="tastilo" />
                                                        <label>Tastilo</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </aside>
                                        <aside class="sidebar-tag filter tags size shop by types 1477476999076">
                                            <div class="widget">
                                                <h4>
                                                    Shop By Types
                                                    <a href="javascript:void(0)" class="clear" style="display:none">
                                                        <i class="icon-close" aria-hidden="true"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="widget-content">
                                                <ul>
                                                    <li>
                                                        <i></i>
                                                        <input type="checkbox" value="cookies" />
                                                        <label>Cookies</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </aside>
                                        <aside class="sidebar-tag filter tags size shop by price 1477477078599">

                                            <div class="widget">
                                                <h4>
                                                    Shop By Price
                                                    <a href="javascript:void(0)" class="clear" style="display:none">
                                                        <i class="icon-close" aria-hidden="true"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="widget-content">
                                                <ul>
                                                    <li>
                                                        <i></i>
                                                        <input type="checkbox" value="300-500" />
                                                        <label>$300 - $500</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </aside>
                                    </div>
                                </div>
                                <div id="shopify-section-sidebar-bestsellers" class="shopify-section">
                                    <div data-section-id="sidebar-bestsellers" data-section-type="home-sidebar-bestsellers"
                                        class="home-sidebar-bestsellers">
                                        <div class="widget widget_top_rated_products">
                                            <h4><span>Best Sellers</span></h4>
                                            <ul class="no-bullets top-products">
                                                <li class="products">
                                                    <span class="top_product_count">01</span>
                                                    <div
                                                        class="top-products-detail product-detail grid__item post-large--one-half">
                                                        <a class="grid-link__title"
                                                            href="../products/elit-esse-cillum.html"> Black and white Ice
                                                            Cream </a>
                                                        <div class="top-product-prices grid-link__meta">

                                                            <div class="product_price">
                                                                <div class="grid-link__org_price">
                                                                    <span class=money>$300.00</span>
                                                                </div>

                                                                <del><span class=money>$351.00</span></del>

                                                            </div>
                                                        </div>

                                                        <span class="shopify-product-reviews-badge"
                                                            data-id="11438905732"></span>
                                                    </div>
                                                    <a class="thumb grid__item post-large--one-half"
                                                        href="../products/elit-esse-cillum.html">
                                                        <img alt="featured product"
                                                            src="https://cdn.shopify.com/s/files/1/2159/5497/products/icecream11_small.jpg?v=1500106491">
                                                    </a>
                                                </li>
                                                <li class="products">
                                                    <span class="top_product_count">02</span>
                                                    <div
                                                        class="top-products-detail product-detail grid__item post-large--one-half">
                                                        <a class="grid-link__title" href="../products/nostrud.html">
                                                            Fortune Ice Cream </a>
                                                        <div class="top-product-prices grid-link__meta">

                                                            <div class="product_price">
                                                                <div class="grid-link__org_price">
                                                                    <span class=money>$300.00</span>
                                                                </div>
                                                                <del><span class=money>$351.00</span></del>
                                                            </div>
                                                        </div>
                                                        <span class="shopify-product-reviews-badge"
                                                            data-id="11438904900"></span>
                                                    </div>
                                                    <a class="thumb grid__item post-large--one-half"
                                                        href="../products/nostrud.html">
                                                        <img alt="featured product"
                                                            src="https://cdn.shopify.com/s/files/1/2159/5497/products/icecream8_small.jpg?v=1500106475">
                                                    </a>
                                                </li>
                                                <li class="products">
                                                    <span class="top_product_count">03</span>
                                                    <div
                                                        class="top-products-detail product-detail grid__item post-large--one-half">
                                                        <a class="grid-link__title" href="../products/excepteur.html">
                                                            Bourbon Ice Cream </a>
                                                        <div class="top-product-prices grid-link__meta">

                                                            <div class="product_price">
                                                                <div class="grid-link__org_price">
                                                                    <span class=money>$300.00</span>
                                                                </div>

                                                                <del><span class=money>$351.00</span></del>

                                                            </div>
                                                        </div>

                                                        <span class="shopify-product-reviews-badge"
                                                            data-id="11438904196"></span>

                                                    </div>




                                                    <a class="thumb grid__item post-large--one-half"
                                                        href="../products/excepteur.html">
                                                        <img alt="featured product"
                                                            src="https://cdn.shopify.com/s/files/1/2159/5497/products/icecream19_small.jpg?v=1500106422">
                                                    </a>

                                                </li>


                                                <li class="products">
                                                    <span class="top_product_count">04</span>
                                                    <div
                                                        class="top-products-detail product-detail grid__item post-large--one-half">
                                                        <a class="grid-link__title" href="../products/ullamco.html">
                                                            Kaasstengels </a>
                                                        <div class="top-product-prices grid-link__meta">

                                                            <div class="product_price">
                                                                <div class="grid-link__org_price">
                                                                    <span class=money>$300.00</span>
                                                                </div>

                                                                <del><span class=money>$351.00</span></del>

                                                            </div>
                                                        </div>

                                                        <span class="shopify-product-reviews-badge"
                                                            data-id="11438904068"></span>

                                                    </div>




                                                    <a class="thumb grid__item post-large--one-half"
                                                        href="../products/ullamco.html">
                                                        <img alt="featured product"
                                                            src="https://cdn.shopify.com/s/files/1/2159/5497/products/icecream16_small.jpg?v=1500106411">
                                                    </a>

                                                </li>


                                            </ul>
                                        </div>
                                    </div>



                                </div>
                                <div id="shopify-section-sidebar-promoimage" class="shopify-section">
                                    <div class="widget widget_promo_img">
                                        <ul id="promo-carousel" class="owl-carousel owl-theme">


                                            <li>
                                                <a href="ice-cream.html" title="Promo Text">
                                                    <img src="https://cdn.shopify.com/s/files/1/2159/5497/files/sidebar-promo2_188e0902-e9a8-4831-b311-778449623d65_500x500.jpg?v=1613542603"
                                                        alt="Promo Text" title="Promo Text" />
                                                </a>
                                            </li>



                                            <li>
                                                <a href="" title="Promo Text">
                                                    <img src="https://cdn.shopify.com/s/files/1/2159/5497/files/sidebar-promo1_500x500.jpg?v=1613542603"
                                                        alt="Promo Text" title="Promo Text" />
                                                </a>
                                            </li>



                                            <li>
                                                <a href="" title="">
                                                    <img src="https://cdn.shopify.com/s/files/1/2159/5497/files/sidebar-promo2_500x500.jpg?v=1613542603"
                                                        alt="" title="" />
                                                </a>
                                            </li>


                                        </ul>
                                    </div>





                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $("#promo-carousel").owlCarousel({
                                                loop: false,
                                                // margin:10,
                                                nav: false,
                                                dots: true,
                                                responsive: {
                                                    0: {
                                                        items: 1
                                                    },
                                                    600: {
                                                        items: 1
                                                    },
                                                    1000: {
                                                        items: 1
                                                    }
                                                }

                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div
                            class="grid__item wide--three-quarters post-large--three-quarters large--three-quarters sidebar-hidden">
                            <div class="collection-list">
                                <div class="grid-uniform grid-link__container col-main">
                                    <header class="section-header section-header--large">
                                        <div class="toolbar">
                                            <div
                                                class="view-mode grid__item wide--two-tenths post-large--two-tenths large--two-tenths">
                                                <a class="grid btn active" href="grid.html" title="Grid view"><span
                                                        class="fa fa-th-large" aria-hidden="true"></span></a>
                                                <a class="list btn" href="list.html" title="List view"><span
                                                        class="fa fa-th-list" aria-hidden="true"></span></a>
                                            </div>
                                            <div
                                                class="grid__item wide--eight-tenths post-large--eight-tenths large--eight-tenths">
                                                <div
                                                    class="filter-sortby grid__item wide--six-tenths post-large--six-tenths large--six-tenths">
                                                    <label for="sort-by">Sort by</label>
                                                    <input type="text" id="sort-by">
                                                    <div class="sorting-section">
                                                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-exchange"></i>
                                                            <span>Featured</span>
                                                            <i class="icon-chevron-down"></i>
                                                        </button>

                                                        <ul class="dropdown-menu" role="menu">
                                                            <li class="active"><a href="manual.html">Featured</a></li>
                                                            <li><a href="price-ascending.html">Price, low to high</a></li>
                                                            <li><a href="price-descending.html">Price, high to low</a></li>
                                                            <li><a href="title-ascending.html"> A-Z</a></li>
                                                            <li><a href="title-descending.html">Z-A</a></li>
                                                            <li><a href="created-ascending.html">Date, old to new</a></li>
                                                            <li><a href="created-descending.html">Date, new to old</a></li>
                                                            <li><a href="best-selling.html">Best Selling</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div
                                                    class="filter-show grid__item wide--four-tenths post-large--four-tenths large--four-tenths">
                                                    <label>Show</label>
                                                    <div class="pages_list">
                                                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-exchange"></i>
                                                            <span>12</span>
                                                            <i class="icon-chevron-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="8.html">8</a></li>
                                                            <li class="active"><a href="12.html">12</a></li>
                                                            <li><a href="24.html">24</a></li>
                                                            <li><a href="36.html">36</a></li>
                                                            <li><a href="all.html">All</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </header>
                                    <div class="products-grid-view">
                                        <ul>
                                            @foreach ($collection as $product)
                                                <li class="grid__item item-row  wide--one-third post-large--one-third large--one-third medium--one-half small-grid__item on-sale"
                                                    id="product-11358365508">
                                                    <div class="products">
                                                        <div class="product-container">
                                                            <a href="{{ route('HomeProduct', ['slug' => $product->slug]) }}"
                                                                class="grid-link">
                                                                <div class="featured-tag">
                                                                    <span class="badge badge--sale">
                                                                        <span class="gift-tag badge__text">
                                                                            {{ $product->sale != 0 ? 'Sale' : null }}
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                                <div class="ImageOverlayCa"></div>
                                                                <img src="https://cdn.shopify.com/s/files/1/2159/5497/products/cookie24.jpg?v=1500098999"
                                                                    class="featured-image" alt="Custard cream">
                                                            </a>
                                                            <div class="ImageWrapper">
                                                                <div class="product-button">
                                                                    <div class="button-row-1">
                                                                        <form
                                                                            action="https://cookie-crumble-01.myshopify.com/cart/add"
                                                                            method="post" class="variants clearfix"
                                                                            id="cart-form-11358365508">
                                                                            <input type="hidden" name="id"
                                                                                value="44595276164" />
                                                                            <a class="add-cart-btn">
                                                                                <i class="icon-basket"></i>
                                                                            </a>
                                                                        </form>
                                                                        <a href="javascript:void(0)"
                                                                            id="a-lasting-impression-thank-you-gift-basket"
                                                                            class="quick-view-text">
                                                                            <i class="icon-eye" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="button-row-2">
                                                                        <a
                                                                            href="{{ route('HomeProduct', ['slug' => $product->slug]) }}">
                                                                            <i class="icon-link" aria-hidden="true"></i>
                                                                        </a>
                                                                        <div class="add-to-wishlist">
                                                                            <div class="show">
                                                                                <div
                                                                                    class="default-wishbutton-a-lasting-impression-thank-you-gift-basket loading">
                                                                                    <a class="add-in-wishlist-js btn"
                                                                                        href="a-lasting-impression-thank-you-gift-basket.html"><i
                                                                                            class="fa fa-heart-o"></i><span
                                                                                            class="tooltip-label">Add to
                                                                                            wishlist</span></a>
                                                                                </div>
                                                                                <div class="loadding-wishbutton-a-lasting-impression-thank-you-gift-basket loading btn"
                                                                                    style="display: none; pointer-events: none">
                                                                                    <a class="add_to_wishlist"
                                                                                        href="a-lasting-impression-thank-you-gift-basket.html"><i
                                                                                            class="fa fa-circle-o-notch fa-spin"></i></a>
                                                                                </div>
                                                                                <div class="added-wishbutton-a-lasting-impression-thank-you-gift-basket loading"
                                                                                    style="display: none;"><a
                                                                                        class="added-wishlist btn add_to_wishlist"
                                                                                        href="../pages/wishlist.html"><i
                                                                                            class="fa fa-heart"></i><span
                                                                                            class="tooltip-label">View
                                                                                            Wishlist</span></a></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail">
                                                            <div class="product_left">
                                                                <a href="{{ route('HomeProduct', ['slug' => $product->slug]) }}"
                                                                    class="grid-link__title">{{ $product->name }}</a>
                                                                <p class="product-vendor">
                                                                    <span>{{ $product->categories->name }}</span>
                                                                </p>
                                                                <div class="grid-link__meta">
                                                                    <div class="product_price">
                                                                        <div class="grid-link__org_price">
                                                                            <span
                                                                                class=money>{{ $product->sale != 0 ? number_format($product->regular_price - ($product->regular_price * $product->sale) / 100) : number_format($product->regular_price) }}
                                                                                VNĐ</span>
                                                                        </div>
                                                                        <del class="grid-link__sale_price"><span
                                                                                class=money>{{ number_format($product->regular_price) }}
                                                                                VNĐ</span></del>
                                                                    </div>
                                                                </div>
                                                                <ul class="item-swatch color_swatch_Value flavour_list">
                                                                    @if ($product->keywords != null)
                                                                        @foreach (explode(',', $product->keywords) as $tag)
                                                                            <li>
                                                                                <span>
                                                                                    <a href=""
                                                                                        class="tags_style">{{ $tag }}</a>
                                                                                </span>
                                                                            </li>
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dt-sc-hr-invisible-large"></div>
    </main>
@stop
