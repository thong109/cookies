@extends('newLayout')
@section('title', __('Products'))
@section('scripts')
@stop
@section('body')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <h1>{{ $search ? __('Keyword : ') . $keyword : __('Products') }}</h1>
        <a href="{{ route('Home') }}" title="Back to the frontpage">{{ __('Home') }}</a>
        <span aria-hidden="true" class="breadcrumb__sep">/</span>
        <span>{{ __('Category') }}</span>
        <span aria-hidden="true" class="breadcrumb__sep">/</span>
        <span>{{ $search ? __('Keyword : ') . $keyword : __('Products') }}</span>
    </nav>
    <main class="main-content">
        <div class="dt-sc-hr-invisible-large"></div>
        <div class="wrapper">
            <div class="grid__item">
                <div class="grid__item">
                    <div class="collection-products">
                        <div class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter left-sidebar">
                            <div class="collection_sidebar">
                                <div id="shopify-section-sidebar-category" class="shopify-section">
                                    <div data-section-id="sidebar-category" data-section-type="Sidebar-category">
                                        <div class="widget widget_product_categories">
                                            <h4>{{ __('Search') }}</h4>
                                            <ul id="SearchDrawer" class="search-bar search-page-form">
                                                <div class="search-bar__table">
                                                    <form action="{{ route('Products') }}" method="get"
                                                        class="search-bar__table-cell search-bar__form" role="search">
                                                        <div class="search-bar__table">
                                                            <div class="search-bar__table-cell search-bar__icon-cell">
                                                                <button type="submit"
                                                                    class="search-bar__icon-button search-bar__submit">
                                                                    <span class="fa fa-search" aria-hidden="true"></span>
                                                                </button>
                                                            </div>
                                                            <div class="search-bar__table-cell">
                                                                <input type="search" id="SearchInput" name="keyword"
                                                                    value="{{ $search ? $keyword : '' }}"
                                                                    placeholder="{{ __('Search') }}..."
                                                                    aria-label="Search..." class="search-bar__input">
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="search-bar__table-cell text-right">
                                                        <button type="button" class="search-bar__icon-button">
                                                        </button>
                                                    </div>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div id="shopify-section-sidebar-category" class="shopify-section">
                                    <div data-section-id="sidebar-category" data-section-type="Sidebar-category">
                                        <div class="widget widget_product_categories">
                                            <h4>{{ __('Category') }}</h4>
                                            <ul class="product-categories dt-sc-toggle-frame-set" id="acardion">
                                                @foreach ($categories as $cate)
                                                    <li class="cat-item cat-item-39 cat-parent ">
                                                        <i></i>
                                                        <a href="#"
                                                            class="dt-sc-toggle accordion-control">{{ $cate->name }}</a>
                                                        @if (count($cate->brands()->get()) > 0)
                                                            <ul class="children dt-sc-toggle-content accordion-panel">
                                                                @foreach ($cate->brands()->get() as $item)
                                                                    <li><a
                                                                            href="{{ route('Products', ['brand' => $item->slug]) }}">{{ $item->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <span class="dt-menu-expand">+</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div id="shopify-section-sidebar-bestsellers" class="shopify-section">
                                    <div data-section-id="sidebar-bestsellers" data-section-type="home-sidebar-bestsellers"
                                        class="home-sidebar-bestsellers">
                                        <div class="widget widget_top_rated_products">
                                            <h4><span>{{ __('Best Sellers') }}</span></h4>
                                            <ul class="no-bullets top-products">
                                                @foreach ($bestSaller as $key => $product)
                                                    <li class="products">
                                                        <div
                                                            class="top-products-detail product-detail grid__item post-large--one-half">
                                                            <a class="grid-link__title"
                                                                href="{{ route('ProductDetail', ['slug' => $product->slug]) }}">
                                                                {{ $product->name }} </a>
                                                            <div class="top-product-prices grid-link__meta">
                                                                <div class="product_price">
                                                                    <div class="grid-link__org_price">
                                                                        <span
                                                                            class=money>{{ $product->sale != 0 ? number_format($product->price - ($product->price * $product->sale) / 100) : number_format($product->price) }}
                                                                            VNĐ</span>
                                                                    </div>
                                                                    <del
                                                                        class="grid-link__sale_price {{ $product->sale == 0 ? 'd-none' : '' }}">
                                                                        <span
                                                                            class=money>{{ number_format($product->price) }}
                                                                            VNĐ</span>
                                                                    </del>
                                                                </div>
                                                            </div>
                                                            <span class="spr-badge" id="spr_badge_11438905732"
                                                                data-rating="4.0"><span
                                                                    class="spr-starrating spr-badge-starrating"><i
                                                                        class="spr-icon spr-icon-star"
                                                                        aria-hidden="true"></i><i
                                                                        class="spr-icon spr-icon-star"
                                                                        aria-hidden="true"></i><i
                                                                        class="spr-icon spr-icon-star"
                                                                        aria-hidden="true"></i><i
                                                                        class="spr-icon spr-icon-star"
                                                                        aria-hidden="true"></i><i
                                                                        class="spr-icon spr-icon-star-empty"
                                                                        aria-hidden="true"></i></span><span
                                                                    class="spr-badge-caption">{{ $product->views . ' ' . __('view') }}
                                                                </span>
                                                            </span>
                                                        </div>
                                                        <a class="thumb grid__item post-large--one-half"
                                                            href="{{ route('ProductDetail', ['slug' => $product->slug]) }}">
                                                            <img alt="{{ $product->slug }}" width="100px" height="100px"
                                                                src="{{ $product->image }}">
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div id="shopify-section-sidebar-promoimage" class="shopify-section">
                                    <div class="widget widget_promo_img">
                                        <ul id="promo-carousel" class="owl-carousel owl-theme owl-loaded owl-drag">
                                            <div class="owl-stage-outer">
                                                <div class="owl-stage"
                                                    style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1080px;">
                                                    <div class="owl-item active" style="width: 360px;">
                                                        <li>
                                                            <a href="/collections/ice-cream" title="Promo Text">
                                                                <img src="//cdn.shopify.com/s/files/1/2159/5497/files/sidebar-promo2_188e0902-e9a8-4831-b311-778449623d65_500x500.jpg?v=1613542603"
                                                                    alt="Promo Text" title="Promo Text">
                                                            </a>
                                                        </li>
                                                    </div>
                                                    <div class="owl-item" style="width: 360px;">
                                                        <li>
                                                            <a href="" title="Promo Text">
                                                                <img src="//cdn.shopify.com/s/files/1/2159/5497/files/sidebar-promo1_500x500.jpg?v=1613542603"
                                                                    alt="Promo Text" title="Promo Text">
                                                            </a>
                                                        </li>
                                                    </div>
                                                    <div class="owl-item" style="width: 360px;">
                                                        <li>
                                                            <a href="" title="">
                                                                <img src="//cdn.shopify.com/s/files/1/2159/5497/files/sidebar-promo2_500x500.jpg?v=1613542603"
                                                                    alt="" title="">
                                                            </a>
                                                        </li>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="owl-nav disabled">
                                                <div class="owl-prev">prev</div>
                                                <div class="owl-next">next</div>
                                            </div>
                                            <div class="owl-dots">
                                                <div class="owl-dot active"><span></span></div>
                                                <div class="owl-dot"><span></span></div>
                                                <div class="owl-dot"><span></span></div>
                                            </div>
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
                                    @if (count($productByCategory) > 0)
                                        <div class="products-grid-view">
                                            <ul>
                                                @foreach ($productByCategory as $item)
                                                    <li class="grid__item item-row  wide--one-third post-large--one-third large--one-third medium--one-half small-grid__item on-sale"
                                                        id="product-11358364740">
                                                        <div class="products">
                                                            <div class="product-container">
                                                                <a href="{{ route('ProductDetail', ['slug' => $item->slug]) }}"
                                                                    class="grid-link">
                                                                    <div
                                                                        class="featured-tag {{ $item->sale > 0 ? '' : 'd-none' }}">
                                                                        <span class="badge badge--sale">
                                                                            <span
                                                                                class="gift-tag badge__text">{{ $item->sale > 0 ? __('Sale') : '' }}</span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="ImageOverlayCa"></div>
                                                                    <div class="reveal">
                                                                        <span class="product-additional">
                                                                            <img src="{{ '/camera/public/gallery/' . $item->gallery()->first()->gallery_image }}"
                                                                                height="260px" width="100%"
                                                                                alt="{{ $item->name }}" />
                                                                        </span>
                                                                        <img src="{{ $item->image }}" height="260px"
                                                                            width="100%" class="featured-image"
                                                                            alt="{{ $item->name }}">
                                                                    </div>
                                                                </a>
                                                                <div class="ImageWrapper">
                                                                    <div class="product-button">
                                                                        <div class="button-row-1">
                                                                            <input type="hidden" value="1"
                                                                                class="cart_product_qty_{{ $item->id }}">
                                                                            <input type="hidden"
                                                                                value="{{ $item->id }}"
                                                                                class="cart_product_id_{{ $item->id }}">
                                                                            <input type="hidden"
                                                                                value="{{ $item->name }}"
                                                                                class="cart_product_name_{{ $item->id }}">
                                                                            <input type="hidden"
                                                                                value="{{ $item->image }}"
                                                                                class="cart_product_image_{{ $item->id }}">
                                                                            <input type="hidden"
                                                                                value="{{ $item->quantity }}"
                                                                                class="cart_product_quantity_{{ $item->id }}">
                                                                            <input type="hidden"
                                                                                value="{{ $item->price - ($item->price * $item->sale) / 100 }}"
                                                                                class="cart_product_price_{{ $item->id }}">
                                                                            <input type="hidden"
                                                                                value="{{ $item->brands->name }}"
                                                                                class="cart_product_brand_{{ $item->id }}">
                                                                            <input type="hidden"
                                                                                value="{{ $item->slug }}"
                                                                                class="cart_product_slug_{{ $item->id }}">
                                                                            <a class="add-cart-btn AddToCart"
                                                                                data-id_product="{{ $item->id }}">
                                                                                <i class="icon-basket"></i>
                                                                            </a>
                                                                            <a type="button"
                                                                                view-id="{{ $item->id }}"
                                                                                class="quick-view-text">
                                                                                <i class="fa-solid fa-eye"></i>
                                                                            </a>
                                                                        </div>
                                                                        <div class="button-row-2">
                                                                            <a
                                                                                href="{{ route('ProductDetail', ['slug' => $item->slug]) }}">
                                                                                <i class="icon-link"
                                                                                    aria-hidden="true"></i>
                                                                            </a>
                                                                            <div class="add-to-wishlist">
                                                                                <div class="showWishlist">
                                                                                    @php
                                                                                        $arr = [];
                                                                                        foreach ($wishlist as $val) {
                                                                                            array_push($arr, $val->product_id);
                                                                                        }
                                                                                    @endphp
                                                                                    <div class="default-wishbutton-monkey-love-valentines-gift-pail-basket loading"
                                                                                        style="{{ in_array($item->id, $arr) > 0 ? 'display: none;' : 'display: block;' }}">
                                                                                        <input type="hidden"
                                                                                            class="product-id"
                                                                                            value="{{ $item->id }}">
                                                                                        <a class="add-in-wishlist-js btn"><i
                                                                                                class="fa-regular fa-heart"></i><span
                                                                                                class="tooltip-label">{{ __('Wishlist') }}</span></a>
                                                                                    </div>
                                                                                    <div class="loadding-wishbutton-monkey-love-valentines-gift-pail-basket loading btn"
                                                                                        style="display: none; pointer-events: none">
                                                                                        <a class="add_to_wishlist"><i
                                                                                                class="fa fa-circle-o-notch fa-spin"></i></a>
                                                                                    </div>
                                                                                    <div class="added-wishbutton-monkey-love-valentines-gift-pail-basket loading"
                                                                                        style="{{ in_array($item->id, $arr) > 0 ? 'display: block;' : 'display: none;' }}">
                                                                                        <a class="added-wishlist btn add_to_wishlist"
                                                                                            href="{{ route('Wishlist') }}"><i
                                                                                                class="fa-solid fa-heart"></i><span
                                                                                                class="tooltip-label">{{ __('View Wishlist') }}</span></a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="product-detail">
                                                                <div class="product_left">
                                                                    <a href="{{ route('ProductDetail', ['slug' => $item->slug]) }}"
                                                                        class="grid-link__title">{{ $item->name }}</a>
                                                                    <p class="product-vendor">
                                                                        <span>{{ $item->brands->name }}</span>
                                                                    </p>
                                                                    <div class="grid-link__meta">
                                                                        <div class="product_price">
                                                                            <div class="grid-link__org_price">
                                                                                <span
                                                                                    class=money>{{ $item->sale != 0 ? number_format($item->price - ($item->price * $item->sale) / 100) : number_format($item->price) }}
                                                                                    VNĐ</span>
                                                                            </div>
                                                                            <del
                                                                                class="grid-link__sale_price {{ $item->sale == 0 ? 'd-none' : '' }}">
                                                                                <span
                                                                                    class=money>{{ number_format($item->price) }}
                                                                                    VNĐ</span>
                                                                            </del>
                                                                        </div>
                                                                    </div>
                                                                    <ul
                                                                        class="item-swatch color_swatch_Value flavour_list">
                                                                        @if ($item->tags != null)
                                                                            @foreach (explode(',', $item->tags) as $tag)
                                                                                <li>
                                                                                    <span>
                                                                                        <a href="{{ route('Products', ['keyword' => $tag]) }}"
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
                                                    <div class="text-center padding">
                                                        {{ $productByCategory->appends(request()->input())->links() }}
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <p class="border-bottom  text-center p-3 d-grid">
                                            {{ __('Products does not exist') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dt-sc-hr-invisible-large"></div>
    </main>
@endsection
