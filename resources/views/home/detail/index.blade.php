@extends('layouts.app')
@section('title', $getProductBySlug['name'] . ' - Cookie Crumble')
@section('body')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <h1>{{ $getProductBySlug->name }}</h1>
        <a href="{{ route('/') }}" title="Back to the frontpage">Home</a>
        <span aria-hidden="true" class="breadcrumb__sep">/</span>
        <a href="{{ route('Collection', ['slug' => $getProductBySlug->categories->slug]) }}"
            title="">{{ $getProductBySlug->categories->name }}</a>
        <span aria-hidden="true" class="breadcrumb__sep">/</span>
        <span>{{ $getProductBySlug->name }}</span>
    </nav>
    <main class="main-content">
        <div class="dt-sc-hr-invisible-large"></div>
        <div class="wrapper">
            <div class="grid__item">
            </div>
        </div>
        <div class="container">
            <div itemscope="" class="single-product-layout-type-9">
                <div class="product-single">
                    <div class="grid__item">
                        <div
                            class="grid__item wide--three-tenths post-large--three-tenths large--three-tenths  product-img-box">
                            <div class="product-photo-container">
                                <a
                                    href="https://cdn.shopify.com/s/files/1/2159/5497/products/icecream5_1024x1024.jpg?v=1500106230">
                                    <img id="product-featured-image"
                                        src="//cdn.shopify.com/s/files/1/2159/5497/products/icecream5_grande.jpg?v=1500106230"
                                        alt="Bath Oliver"
                                        data-zoom-image="//cdn.shopify.com/s/files/1/2159/5497/products/icecream5_1024x1024.jpg?v=1500106230">
                                </a>
                            </div>
                            <div class="more-view-wrapper hidden  more-view-wrapper-owlslider ">
                                <ul id="ProductThumbs" class="product-photo-thumbs  owl-carousel owl-loaded owl-drag">
                                    <div class="owl-stage-outer">
                                        <div class="owl-stage"
                                            style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s;">
                                            <div class="owl-item">
                                                <li class="grid-item">
                                                    <a href="javascript:void(0)"
                                                        data-image="https://cdn.shopify.com/s/files/1/2159/5497/products/icecream5_grande.jpg?v=1500106230"
                                                        data-zoom-image="//cdn.shopify.com/s/files/1/2159/5497/products/icecream5_1024x1024.jpg?v=1500106230">
                                                        <img src="https://cdn.shopify.com/s/files/1/2159/5497/products/icecream5_medium.jpg?v=1500106230"
                                                            alt="Bath Oliver">
                                                    </a>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-dots disabled"></div>
                                </ul>
                                <div class="single-page-owl-carousel disabled">
                                    <div class="owl-prev disabled"><a class="prev"><i
                                                class="icon-arrow-left icons"></i></a></div>
                                    <div class="owl-next disabled"><a class="next"><i
                                                class="icon-arrow-right icons"></i></a></div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="grid__item wide--four-tenths post-large--four-tenths large--four-tenths product-description-section">
                            <h2 itemprop="name" class="product-single__title">{{ $getProductBySlug->name }}</h2>
                            <span class="shopify-product-reviews-badge" data-id="11438900932"></span>
                            <p class="product-type">
                                <label>Category : </label>
                                <span>{{ $getProductBySlug->categories->name }}</span>
                            </p>
                            <div class="product-description rte" itemprop="description">
                                <p>
                                    {{ $getProductBySlug->short_description }}
                                </p>
                            </div>
                            <div class="share_this_btn">
                                <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                                    <a class="addthis_button_preferred_1"></a>
                                    <a class="addthis_button_preferred_2"></a>
                                    <a class="addthis_button_preferred_3"></a>
                                    <a class="addthis_button_preferred_4"></a>
                                    <a class="addthis_button_compact"></a>
                                    <a class="addthis_counter addthis_bubble_style"></a>
                                </div>
                                <script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-525fbbd6215b4f1a"></script>
                            </div>
                        </div>
                        <div
                            class="grid__item wide--three-tenths post-large--three-tenths large--two-three product_single_detail_section">
                            <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                <meta itemprop="priceCurrency" content="USD">
                                <link itemprop="availability" href="http://schema.org/InStock">
                                <div class="product-infor">
                                    <p class="product-inventory" id="product-inventory">
                                        <label>Availability : </label>
                                        <span
                                            class="many-in-stock">{{ $getProductBySlug->quantity > 0 ? 'Many In Stock' : 'Out of stock' }}</span>
                                    </p>
                                </div>
                                <div class="product_single_price">
                                    <del class="grid-link__sale_price" id="ComparePrice"><span
                                            class="money">{{ $getProductBySlug->sale != 0 ? number_format($getProductBySlug->regular_price) . ' VNĐ' : null }}
                                        </span></del>
                                    <div class="product_price">
                                        <div class="grid-link__org_price" id="ProductPrice"><span
                                                class="money">{{ $getProductBySlug->sale != 0 ? number_format($getProductBySlug->regular_price - ($getProductBySlug->regular_price * $getProductBySlug->sale) / 100) : number_format($getProductBySlug->regular_price) }}
                                                VNĐ</span></div>
                                    </div>
                                </div>
                                <form action="https://cookie-crumble-01.myshopify.com/cart/add" method="post"
                                    enctype="multipart/form-data" id="AddToCartForm">
                                    <div class="selector-wrapper-secton">
                                        <style>
                                            label[for="product-select-option-0"] {
                                                display: none;
                                            }

                                            #product-select-option-0 {
                                                display: none;
                                            }

                                            #product-select-option-0+.custom-style-select-box {
                                                display: none !important;
                                            }
                                        </style>
                                        <script>
                                            $(window).load(function() {
                                                $('.selector-wrapper:eq(0)').hide();
                                            });
                                        </script>
                                        {{-- <div class="swatch clearfix" data-option-index="0">
                                            <div class="header">Color</div>
                                            <div class="swatch-section">
                                                <div data-value="Pink" class="swatch-element color pink available">
                                                    <div class="tooltip">Pink</div>
                                                    <input id="swatch-0-pink" type="radio" name="option-0"
                                                        value="Pink">
                                                    <label for="swatch-0-pink"
                                                        style="background-color: pink; background-image: url(https://cdn.shopify.com/s/files/1/2159/5497/files/pink.png?v=319051796223911864)">
                                                        <img class="crossed-out"
                                                            src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/soldout.png?v=66253127043540372081538730566"
                                                            alt="Sold Out">
                                                    </label>
                                                </div>
                                                <script>
                                                    jQuery('.swatch[data-option-index="0"] .pink').removeClass('soldout').addClass('available').find(':radio')
                                                        .removeAttr('disabled');
                                                    $('.white  input:checked + label').addClass("white-tick");
                                                    $('.default-title').parents('.swatch').addClass("gomes");
                                                    $(".gomes .header").hide();
                                                    $(".gomes .default-title").hide();
                                                </script>
                                                <script>
                                                    jQuery('.swatch[data-option-index="0"] .pink').removeClass('soldout').addClass('available').find(':radio')
                                                        .removeAttr('disabled');
                                                    $('.white  input:checked + label').addClass("white-tick");
                                                    $('.default-title').parents('.swatch').addClass("gomes");
                                                    $(".gomes .header").hide();
                                                    $(".gomes .default-title").hide();
                                                </script>
                                                <script>
                                                    jQuery('.swatch[data-option-index="0"] .pink').removeClass('soldout').addClass('available').find(':radio')
                                                        .removeAttr('disabled');
                                                    $('.white  input:checked + label').addClass("white-tick");
                                                    $('.default-title').parents('.swatch').addClass("gomes");
                                                    $(".gomes .header").hide();
                                                    $(".gomes .default-title").hide();
                                                </script>
                                            </div>
                                        </div> --}}
                                        <div class="swatch clearfix" data-option-index="1">
                                            <div class="header">Flavor</div>
                                            <div class="swatch-section">
                                                @if ($getProductBySlug->keywords != null)
                                                    @foreach (explode(',', $getProductBySlug->keywords) as $tag)
                                                        <div data-value="Blueberry"
                                                            class="swatch-element blueberry available">
                                                            <a href=""><label
                                                                    for="swatch-1-blueberry">{{ $tag }}</label></a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="selector-wrapper" style="display: none;">
                                            <label for="productSelect-option-0">Color</label>
                                            <div class="selector-arrow">
                                                <select class="single-option-selector" data-option="option1"
                                                    id="productSelect-option-0">
                                                    <option value="Pink">Pink</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="selector-wrapper" style="display: none;">
                                            <label for="productSelect-option-1">Flavor</label>
                                            <div class="selector-arrow">
                                                <select class="single-option-selector" data-option="option2"
                                                    id="productSelect-option-1">
                                                    <option value="Strawberry">Strawberry</option>
                                                    <option value="Blueberry">Blueberry</option>
                                                    <option value="Caramel">Caramel</option>
                                                </select>
                                            </div>
                                        </div>
                                        <select name="id" id="productSelect" class="product-single__variants"
                                            style="display: none;">
                                            <option selected="selected" value="45377461764">Pink / Strawberry</option>
                                            <option value="47514469316">Pink / Blueberry</option>
                                            <option value="47514484804">Pink / Caramel</option>
                                        </select>
                                    </div>
                                    <div class="product-single__quantity">
                                        <div class="quantity-box-section">
                                            <label>Quantity : </label>
                                            <div class="quantity-box">
                                                <select name="quantity" id="quantity">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="add" id="AddToCart" class="btn">
                                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i><span
                                            id="AddToCartText">Add to Cart</span>
                                    </button>
                                </form>
                            </div>
                            <div class="add-to-wishlist">
                                <div class="show">
                                    <div class="default-wishbutton-commodo loading"><a class="add-in-wishlist-js btn"
                                            href="commodo.html"><i class="fa fa-heart-o"></i><span
                                                class="tooltip-label">Add to wishlist</span></a></div>
                                    <div class="loadding-wishbutton-commodo loading btn"
                                        style="display: none; pointer-events: none"><a class="add_to_wishlist"
                                            href="commodo.html"><i class="fa fa-circle-o-notch fa-spin"></i></a></div>
                                    <div class="added-wishbutton-commodo loading" style="display: none;"><a
                                            class="added-wishlist btn add_to_wishlist" href="../pages/wishlist.html"><i
                                                class="fa fa-heart"></i><span class="tooltip-label">View
                                                Wishlist</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="buddha-products-nav-section" style="margin-top: 0">
                        <div class="buddha-products-nav">
                        </div>
                        <div class="buddha-products-nav">
                        </div>
                    </div>
                </div>
                <div class="dt-sc-hr-invisible-large"></div>
                <div class="dt-sc-tabs-container">
                    <ul class="dt-sc-tabs">
                        <li><a href="#" class=""> Description </a></li>
                        <li><a href="#" class=""> Reviews </a></li>
                        <li><a href="#" class="current"> Shipping details </a></li>
                    </ul>
                    <div class="dt-sc-tabs-content" id="desc_pro" style="display: none;">
                        <p></p>
                        {!! $getProductBySlug->description !!}
                        <p></p>
                    </div>
                    <div class="dt-sc-tabs-content" style="display: none;">
                        <div class="commentlist">
                            <div class="comment-text">
                                <div class="rating-review">
                                    <div id="shopify-product-reviews" data-id="11438900932">
                                        <style scoped="">
                                            .spr-container {
                                                padding: 24px;
                                                border-color: #ececec;
                                            }

                                            .spr-review,
                                            .spr-form {
                                                border-color: #ececec;
                                            }
                                        </style>
                                        <div class="spr-container">
                                            <div class="spr-header">
                                                <h2 class="spr-header-title">Customer Reviews</h2>
                                                <div class="spr-summary">
                                                    <span class="spr-starrating spr-summary-starrating">
                                                        <i class="spr-icon spr-icon-star"></i><i
                                                            class="spr-icon spr-icon-star"></i><i
                                                            class="spr-icon spr-icon-star"></i><i
                                                            class="spr-icon spr-icon-star"></i><i
                                                            class="spr-icon spr-icon-star"></i>
                                                    </span>
                                                    <span class="spr-summary-caption"><span
                                                            class="spr-summary-actions-togglereviews">Based on 1
                                                            review</span>
                                                    </span><span class="spr-summary-actions">
                                                        <a href="#" class="spr-summary-actions-newreview"
                                                            onclick="SPR.toggleForm(11438900932);return false">Write a
                                                            review</a>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="spr-content">
                                                <div class="spr-form" id="form_11438900932" style="display: none"></div>
                                                <div class="spr-reviews" id="reviews_11438900932"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dt-sc-tabs-content" style="display: block;">
                        <p></p>
                        abc
                        <p></p>
                    </div>
                </div>
                <div class="related-products-container">
                    <div class="dt-sc-hr-invisible-large"></div>
                    <div class="section-header section-header--small">
                        <div class="border-title">
                            <h4>Related Products</h4>
                            <h2 class="section-header__title">
                                From this Collection
                            </h2>
                        </div>
                    </div>
                    <div class="dt-sc-hr-invisible-small"></div>
                    <div class="cs-style-3">
                        @foreach ($getRelatedProduct as $product)
                            <div
                                class="column grid__item wide--one-fifth post-large--one-fifth large--one-third medium--one-third small-grid__item  small--grid__item text-center gallery no-space">
                                <div class="grid__item item-row" id="">
                                    <div class="products wow fadeIn">
                                        <div class="product-container">
                                            <a href="collections/frontpage/products/youre-beary-huggable-kids-valentine-gift-basket.html"
                                                class="grid-link">
                                                <div class="featured-tag">
                                                    <span class="badge badge--sale">
                                                        <span class="gift-tag badge__text">
                                                            {{ $product->sale != 0 ? 'Sale' : null }}
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="ImageOverlayCa"></div>
                                                <img src="https://cdn.shopify.com/s/files/1/2159/5497/products/cookie22.jpg?v=1500098926"
                                                    class="featured-image" alt="Coconut macaroon">
                                            </a>
                                            <div class="ImageWrapper">
                                                <div class="product-button">
                                                    <div class="button-row-1">
                                                        <a href="javascript:void(0)"
                                                            id="youre-beary-huggable-kids-valentine-gift-basket"
                                                            class="quick-view-text">
                                                            <i class="icon-eye" aria-hidden="true"></i>
                                                        </a>
                                                        <a
                                                            href="products/youre-beary-huggable-kids-valentine-gift-basket.html">
                                                            <i class="icon-link" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                    <div class="button-row-2">
                                                        <form action="https://cookie-crumble-01.myshopify.com/cart/add"
                                                            method="post" class="variants clearfix"
                                                            id="cart-form-11358367428">
                                                            <input type="hidden" name="id" value="" />
                                                            <a class="add-cart-btn">
                                                                <i class="icon-bag" aria-hidden="true"></i>
                                                            </a>
                                                        </form>
                                                        <div class="add-to-wishlist">
                                                            <div class="show">
                                                                <div
                                                                    class="default-wishbutton-youre-beary-huggable-kids-valentine-gift-basket loading">
                                                                    <a class="add-in-wishlist-js btn"
                                                                        href="youre-beary-huggable-kids-valentine-gift-basket.html"><i
                                                                            class="fa fa-heart-o"></i><span
                                                                            class="tooltip-label">Add to
                                                                            wishlist</span></a>
                                                                </div>
                                                                <div class="loadding-wishbutton-youre-beary-huggable-kids-valentine-gift-basket loading btn"
                                                                    style="display: none; pointer-events: none">
                                                                    <a class="add_to_wishlist"
                                                                        href="youre-beary-huggable-kids-valentine-gift-basket.html"><i
                                                                            class="fa fa-circle-o-notch fa-spin"></i></a>
                                                                </div>
                                                                <div class="added-wishbutton-youre-beary-huggable-kids-valentine-gift-basket loading"
                                                                    style="display: none;"><a
                                                                        class="added-wishlist btn add_to_wishlist"
                                                                        href="pages/wishlist.html"><i
                                                                            class="fa fa-heart"></i><span
                                                                            class="tooltip-label">View
                                                                            Wishlist</span></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <a href="collections/frontpage/products/youre-beary-huggable-kids-valentine-gift-basket.html"
                                                class="grid-link__title">Coconut macaroon</a>
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
                                                <span class="shopify-product-reviews-badge" data-id=""></span>
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
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="dt-sc-hr-invisible-large"></div>
    </main>
@stop
