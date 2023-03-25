@section('title', $productDetail->name)
@extends('newLayout')

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var related = $(".related-products");
            related.owlCarousel({
                nav: true,
                navContainer: ".nav_featured",
                navText: ['<a class="prev"></a>', '<a class="next"></a>'],
                dots: false,
                singleitem: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('.slideshow-thumbnails').hover(function() {
                changeSlide($(this));
            });

            $(document).mousemove(function(e) {
                var x = e.clientX;
                var y = e.clientY;

                var x = e.clientX;
                var y = e.clientY;

                var imgx1 = $('.slideshow-items.active').offset().left;
                var imgx2 = $('.slideshow-items.active').outerWidth() + imgx1;
                var imgy1 = $('.slideshow-items.active').offset().top;
                var imgy2 = $('.slideshow-items.active').outerHeight() + imgy1;

                if (x > imgx1 && x < imgx2 && y > imgy1 && y < imgy2) {
                    $('#lens').show();
                    $('#result').show();
                    imageZoom($('.slideshow-items.active'), $('#result'), $('#lens'));
                } else {
                    $('#lens').hide();
                    $('#result').hide();
                }

            });

        });

        function imageZoom(img, result, lens) {

            result.width(img.innerWidth());
            result.height(img.innerHeight());
            lens.width(img.innerWidth() / 2);
            lens.height(img.innerHeight() / 2);

            result.offset({
                top: img.offset().top,
                left: img.offset().left + img.outerWidth() + 10
            });

            var cx = img.innerWidth() / lens.innerWidth();
            var cy = img.innerHeight() / lens.innerHeight();

            result.css('backgroundImage', 'url(' + img.attr('src') + ')');
            result.css('backgroundSize', img.width() * cx + 'px ' + img.height() * cy + 'px');

            lens.mousemove(function(e) {
                moveLens(e);
            });
            img.mousemove(function(e) {
                moveLens(e);
            });
            lens.on('touchmove', function() {
                moveLens();
            })
            img.on('touchmove', function() {
                moveLens();
            })

            function moveLens(e) {
                var x = e.clientX - lens.outerWidth() / 2;
                var y = e.clientY - lens.outerHeight() / 2;
                if (x > img.outerWidth() + img.offset().left - lens.outerWidth()) {
                    x = img.outerWidth() + img.offset().left - lens.outerWidth();
                }
                if (x < img.offset().left) {
                    x = img.offset().left;
                }
                if (y > img.outerHeight() + img.offset().top - lens.outerHeight()) {
                    y = img.outerHeight() + img.offset().top - lens.outerHeight();
                }
                if (y < img.offset().top) {
                    y = img.offset().top;
                }
                lens.offset({
                    top: y,
                    left: x
                });
                result.css('backgroundPosition', '-' + (x - img.offset().left) * cx + 'px -' + (y - img.offset().top) * cy +
                    'px');
            }
        }


        function changeSlide(elm) {
            $('.slideshow-items').removeClass('active');
            $('.slideshow-items').eq(elm.index()).addClass('active');
            $('.slideshow-thumbnails').removeClass('active');
            $('.slideshow-thumbnails').eq(elm.index()).addClass('active');
        }
    </script>
@stop
@section('body')
    <div class="product-details" style="border-top:1px solid;">
        <!--product-details-->
        <nav class="breadcrumb" aria-label="breadcrumbs">
            <h1>{{ $productDetail->name }}</h1>
            <a href="{{ route('Home') }}" title="Back to the frontpage">{{ __('Home') }}</a>
            <span aria-hidden="true" class="breadcrumb__sep">/</span>
            <a href="/collections/cookies" title="">{{ $productDetail->brands->name }}</a>
            <span aria-hidden="true" class="breadcrumb__sep">/</span>
            <span>{{ $productDetail->name }}</span>
        </nav>
        <main class="main-content">
            <div class="dt-sc-hr-invisible-large"></div>
            <div class="wrapper">
                <div class="grid__item">
                </div>
            </div>
            <div class="container">
                <div itemscope itemtype="http://schema.org/Product" class="single-product-layout-type-9">
                    <div class="product-single">
                        <div class="grid__item">
                            <div
                                class="grid__item wide--three-tenths post-large--three-tenths large--three-tenths  product-img-box">
                                <div id='lens'></div>
                                <div id='slideshow-items-container'>
                                    @foreach ($productDetail->gallery()->get() as $image)
                                        <img class='slideshow-items {{ $image == $productDetail->gallery()->get()[0] ? 'active' : '' }}'
                                            src='{{ '/camera/public/gallery/' . $image->gallery_image }}'>
                                    @endforeach
                                </div>
                                <div id='result'></div>
                                <div class='row border-top'>
                                    @foreach ($productDetail->gallery()->get() as $image)
                                        <img class='slideshow-thumbnails {{ $image == $productDetail->gallery()->get()[0] ? 'active' : '' }}'
                                            src='{{ '/camera/public/gallery/' . $image->gallery_image }}'>
                                    @endforeach
                                </div>
                            </div>
                            <div
                                class="grid__item wide--four-tenths post-large--four-tenths large--four-tenths product-description-section">
                                <h2 itemprop="name" class="product-single__title">{{ $productDetail->name }}</h2>
                                <span class="shopify-product-reviews-badge" data-id="11358367172"></span>
                                <p class="product-type">
                                    <label>Brand : </label>
                                    <span>{{ $productDetail->brands->name }}</span>
                                </p>
                                <div class="product-description rte" itemprop="description">
                                    {{ $productDetail->content }}
                                </div>
                            </div>
                            <div
                                class="grid__item wide--three-tenths post-large--three-tenths large--two-three product_single_detail_section">
                                <div itemprop="offers" itemscope>
                                    <div class="product-infor">
                                        <p class="product-inventory" id="product-inventory">
                                            <label>{{ __('Status') }} : </label>
                                            <span>
                                                {{ $productDetail->quantity > 0 ? __('Many In Stock') : __('Out of Stock') }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="product_single_price">
                                        <del class="grid-link__sale_price {{ $productDetail->sale > 0 ? '' : 'd-none' }}"
                                            id="ComparePrice"><span
                                                class=money>{{ number_format($productDetail->price) . ' VNĐ' }}</span></del>
                                        <div class="product_price">
                                            <div class="grid-link__org_price" id="ProductPrice">
                                                {{ $productDetail->sale != 0 ? number_format($productDetail->price - ($productDetail->price * $productDetail->sale) / 100) : number_format($productDetail->price) }}
                                                VNĐ
                                            </div>
                                        </div>
                                    </div>

                                    @if ($productDetail->quantity > 0)
                                        <div class="product-single__quantity">
                                            <div class="quantity-box-section">
                                                <label>{{ __('Quantity') }} : </label>
                                                <input type="number" id="quantity" value="1"
                                                    class="cart_product_qty_{{ $productDetail->id }} border">
                                            </div>
                                        </div>
                                        <a type="button" name="add" class="btn AddToCart" id="AddToCart"
                                            data-id_product="{{ $productDetail->id }}">
                                            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                            <span id="AddToCartText">{{ __('AddToCart') }}</span>
                                        </a>
                                    @else
                                        <div class="product-single__quantity">
                                            <div class="quantity-box-section">
                                                <label>{{ __('Quantity') }} : </label>
                                                <input type="number" id="quantity" value="1" class="border" readonly>
                                            </div>
                                        </div>
                                        <a class="btn AddToCart" id="AddToCart">
                                            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                            <span id="AddToCartText">{{ __('Sold off') }}</span>
                                        </a>
                                    @endif
                                    </a>
                                    <input type="hidden" value="{{ $productDetail->id }}"
                                        class="cart_product_id_{{ $productDetail->id }}">
                                    <input type="hidden" value="{{ $productDetail->name }}"
                                        class="cart_product_name_{{ $productDetail->id }}">
                                    <input type="hidden" value="{{ $productDetail->image }}"
                                        class="cart_product_image_{{ $productDetail->id }}">
                                    <input type="hidden" value="{{ $productDetail->quantity }}"
                                        class="cart_product_quantity_{{ $productDetail->id }}">
                                    <input type="hidden"
                                        value="{{ $productDetail->price - ($productDetail->price * $productDetail->sale) / 100 }}"
                                        class="cart_product_price_{{ $productDetail->id }}">
                                    <input type="hidden" value="{{ $productDetail->brands->name }}"
                                        class="cart_product_brand_{{ $productDetail->id }}">
                                    <input type="hidden" value="{{ $productDetail->slug }}"
                                        class="cart_product_slug_{{ $productDetail->id }}">
                                </div>
                                <div class="add-to-wishlist">
                                    <div class="showWishlist">
                                        <div class="default-wishbutton-monkey-love-valentines-gift-pail-basket loading"
                                            style="{{ $wishlist > 0 ? 'display: none;' : 'display: block;' }}"
                                            data-id="{{ $productDetail->id }}"><a class="add-in-wishlist-js btn">
                                                <input type="hidden" class="product-id"
                                                    value="{{ $productDetail->id }}"><i
                                                    class="fa-regular fa-heart"></i><span
                                                    class="tooltip-label">{{ __('Wishlist') }}</span></a></div>
                                        <div class="loadding-wishbutton-monkey-love-valentines-gift-pail-basket loading btn"
                                            style="display: none; pointer-events: none"><a class="add_to_wishlist"><i
                                                    class="fa fa-circle-o-notch fa-spin"></i></a></div>
                                        <div class="added-wishbutton-monkey-love-valentines-gift-pail-basket loading"
                                            style="{{ $wishlist > 0 ? 'display: block;' : 'display: none;' }}"><a
                                                class="added-wishlist btn add_to_wishlist"
                                                href="{{ route('Wishlist') }}"><i class="fa-solid fa-heart"></i><span
                                                    class="tooltip-label">{{ __('View Wishlist') }}</span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="buddha-products-nav-section">
                            <div class="buddha-products-nav {{ $prePro != null ? '' : 'd-none' }}">
                                <div class="product-btn product-prev">
                                    <a class="btn"
                                        href="{{ $prePro != null ? route('ProductDetail', ['slug' => $prePro['slug']]) : '' }}">Previous
                                        product<span></span></a>
                                    <div class="wrapper-short">
                                        <div class="product-short">
                                            <a href="{{ $prePro != null ? route('ProductDetail', ['slug' => $prePro['slug']]) : '' }}"
                                                class="product-thumb">
                                                <img src="{{ $prePro != null ? $prePro['image'] : '' }}"
                                                    class="attachment-shop_thumbnail" alt=""
                                                    srcset="{{ $prePro != null ? $prePro['image'] : '' }}"> </a>
                                            <a href="{{ $prePro != null ? route('ProductDetail', ['slug' => $prePro['slug']]) : '' }}"
                                                class="product-title">{{ $prePro != null ? $prePro->name : '' }}</a>
                                            <span class="price">
                                                <del class="{{ $prePro != null && $prePro['sale'] > 0 ? '' : 'd-none' }}">
                                                    <span
                                                        class="money">{{ $prePro != null ? number_format($prePro['price']) . ' VNĐ' : '' }}</span>
                                                </del>
                                                <ins>
                                                    <span>
                                                        <span
                                                            class="money">{{ $prePro != null ? number_format($prePro->price - ($prePro->price * $prePro->sale) / 100) . ' VNĐ' : '' }}</span>
                                                    </span>
                                                </ins>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="buddha-products-nav {{ $nextPro != null ? '' : 'd-none' }}">
                                <div class="product-btn product-next">
                                    <a class="btn"
                                        href="{{ $nextPro != null ? route('ProductDetail', ['slug' => $nextPro['slug']]) : '' }}">Previous
                                        product<span></span></a>
                                    <div class="wrapper-short">
                                        <div class="product-short">
                                            <a href="{{ $nextPro != null ? route('ProductDetail', ['slug' => $nextPro['slug']]) : '' }}"
                                                class="product-thumb">
                                                <img src="{{ $nextPro != null ? $nextPro['image'] : '' }}"
                                                    class="attachment-shop_thumbnail" alt=""
                                                    srcset="{{ $nextPro != null ? $nextPro['image'] : '' }}">
                                            </a>
                                            <a href="{{ $nextPro != null ? route('ProductDetail', ['slug' => $nextPro['slug']]) : '' }}"
                                                class="product-title">{{ $nextPro != null ? $nextPro->name : '' }}</a>
                                            <span class="price">
                                                <del
                                                    class="{{ $nextPro != null && $nextPro['sale'] > 0 ? '' : 'd-none' }}">
                                                    <span class="money"
                                                        data-currency-aud="{{ $nextPro != null ? number_format($nextPro['price']) . ' VNĐ' : '' }}"
                                                        data-currency="AUD">{{ $nextPro != null ? number_format($nextPro['price']) . ' VNĐ' : '' }}</span>
                                                </del>
                                                <ins>
                                                    <span>
                                                        <span class="money"
                                                            data-currency-aud="{{ $nextPro != null ? number_format($nextPro->price - ($nextPro->price * $nextPro->sale) / 100) . ' VNĐ' : '' }}"
                                                            data-currency="AUD">{{ $nextPro != null ? number_format($nextPro->price - ($nextPro->price * $nextPro->sale) / 100) . ' VNĐ' : '' }}</span>
                                                    </span>
                                                </ins>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="dt-sc-hr-invisible-large"></div>
                    <div class="dt-sc-tabs-container">

                        <div class="dt-sc-tabs-content" id="desc_pro">
                            {!! $productDetail->description !!}
                        </div>
                        <div class="dt-sc-tabs-content">
                            <div class="commentlist">
                                <div class="comment-text">
                                    <div class="rating-review">
                                        <div id="shopify-product-reviews" data-id="11358367172">
                                            <div class="spr-container">
                                                <div class="spr-header">
                                                    <h2 class="spr-header-title">{{ __('Customer Reviews') }}</h2>
                                                </div>
                                                <div class="spr-content">
                                                    @if (Session::get('customer'))
                                                        <div class="spr-form" id="form_11358367876" style="">
                                                            <form method="post" action="{{ route('SendComment') }}"
                                                                id="new-review-form_11358367876" class="new-review-form">
                                                                @csrf
                                                                <h3 class="spr-form-title">{{ __('Write a review') }}</h3>
                                                                <fieldset class="spr-form-contact">
                                                                    <div class="spr-form-contact-name">
                                                                        <label class="spr-form-label"
                                                                            for="review_author_11358367876">{{ __('Name') }}</label>
                                                                        <input class="spr-form-input spr-form-input-text "
                                                                            id="review_author_11358367876" type="text"
                                                                            name="comment_name"
                                                                            value="{{ Session::get('customer')['customer_name'] }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="spr-form-contact-email">
                                                                        <label class="spr-form-label"
                                                                            for="review_email_11358367876">{{ __('Email') }}</label>
                                                                        <input class="spr-form-input spr-form-input-email "
                                                                            id="review_email_11358367876" type="email"
                                                                            name="comment_email"
                                                                            value="{{ Session::get('customer')['customer_email'] }}"
                                                                            readonly>
                                                                    </div>
                                                                    <input type="hidden" name="customer_id"
                                                                        value="{{ Session::get('customer')['customer_id'] }}">
                                                                    <input type="hidden" name="comment_product_id"
                                                                        value="{{ $productDetail->id }}">
                                                                    <div class="spr-form-review-rating">
                                                                        <label class="spr-form-label"
                                                                            for="review[rating]">{{ __('Rating') }}</label>
                                                                        <div class="spr-form-input spr-starrating ">
                                                                            <div class="personal-rating">
                                                                                <div class="rate">
                                                                                    <input type="radio" id="star5"
                                                                                        name="rating" value="5" />
                                                                                    <label for="star5" title="text">5
                                                                                        stars</label>
                                                                                    <input type="radio" id="star4"
                                                                                        name="rating" value="4" />
                                                                                    <label for="star4" title="text">4
                                                                                        stars</label>
                                                                                    <input type="radio" id="star3"
                                                                                        name="rating" value="3" />
                                                                                    <label for="star3" title="text">3
                                                                                        stars</label>
                                                                                    <input type="radio" id="star2"
                                                                                        name="rating" value="2" />
                                                                                    <label for="star2" title="text">2
                                                                                        stars</label>
                                                                                    <input type="radio" id="star1"
                                                                                        name="rating" value="1" />
                                                                                    <label for="star1" title="text">1
                                                                                        star</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="spr-form-review-body">
                                                                        <label class="spr-form-label"
                                                                            for="review_body_11358367876">
                                                                            {{ __('Comments') }}
                                                                        </label>
                                                                        <div class="spr-form-input">
                                                                            <textarea class="spr-form-input spr-form-input-textarea " id="review_body_11358367876" data-product-id="11358367876"
                                                                                name="comment" rows="5" placeholder="{{ __('Write your comments here') }}"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <input type="submit"
                                                                        class="spr-button spr-button-primary button button-primary btn btn-primary"
                                                                        value="{{ __('Submit Review') }}">
                                                                </fieldset>
                                                            </form>
                                                        </div>
                                                    @endif
                                                    <div class="spr-reviews" id="reviews_11358367876">
                                                        @foreach ($comments as $comment)
                                                            <div class="spr-review" id="spr-review-138390036">
                                                                <div class="spr-review-header">
                                                                    <div class="rating">
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            @if ($i <= $comment->rating)
                                                                                <i class="fa fa-star"></i>
                                                                            @else
                                                                                <i class="fa fa-star-o"></i>
                                                                            @endif
                                                                        @endfor
                                                                    </div>
                                                                    <span
                                                                        class="spr-review-header-byline"><strong>{{ $comment->comment_name }}</strong>
                                                                        on
                                                                        <strong>{{ date('H:i , M d Y', strtotime($comment->comment_date)) }}</strong></span>
                                                                </div>

                                                                <div class="spr-review-content">
                                                                    <p class="spr-review-content-body">
                                                                        {{ $comment->comment }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="related-products-container">
                        <div class="dt-sc-hr-invisible-large"></div>
                        <div class="section-header section-header--small">
                            <div class="border-title">
                                <h4>{{ __('Related Products') }}</h4>
                                <h2 class="section-header__title">
                                    {{ __('From this Collection') }}
                                </h2>
                            </div>
                        </div>
                        <div class="dt-sc-hr-invisible-small"></div>
                        <ul class="grid-uniform grid-link__container related-products owl-carousel owl-theme">
                            @if (count($relatedProduct) > 0)
                                @foreach ($relatedProduct as $product)
                                    <li class="grid__item item-row {{ $product->sale > 0 ? 'on-sale' : '' }}">
                                        <div class="products">
                                            <div class="product-container">
                                                <a href="{{ route('ProductDetail', ['slug' => $product->slug]) }}"
                                                    class="grid-link">
                                                    <div class="featured-tag {{ $product->sale > 0 ? '' : 'd-none' }}">
                                                        <span class="badge badge--sale">
                                                            <span
                                                                class="gift-tag badge__text">{{ $product->sale > 0 ? __('Sale') : '' }}</span>
                                                        </span>
                                                    </div>
                                                    <div class="ImageOverlayCa"></div>
                                                    <div class="reveal">
                                                        <span class="product-additional">
                                                            <img src="{{ '/camera/public/gallery/' . $product->gallery()->first()->gallery_image }}"
                                                                alt="Charcoal biscuit" />
                                                        </span>
                                                        <img src="{{ $product->image }}" class="featured-image"
                                                            alt="Charcoal biscuit">
                                                    </div>
                                                </a>
                                                <div class="ImageWrapper">
                                                    <div class="product-button">
                                                        <div class="button-row-1">
                                                            <input type="hidden" value="1"
                                                                class="cart_product_qty_{{ $product->id }}">
                                                            <input type="hidden" value="{{ $product->id }}"
                                                                class="cart_product_id_{{ $product->id }}">
                                                            <input type="hidden" value="{{ $product->name }}"
                                                                class="cart_product_name_{{ $product->id }}">
                                                            <input type="hidden" value="{{ $product->image }}"
                                                                class="cart_product_image_{{ $product->id }}">
                                                            <input type="hidden" value="{{ $product->quantity }}"
                                                                class="cart_product_quantity_{{ $product->id }}">
                                                            <input type="hidden"
                                                                value="{{ $product->price - ($product->price * $product->sale) / 100 }}"
                                                                class="cart_product_price_{{ $product->id }}">
                                                            <input type="hidden" value="{{ $product->brands->name }}"
                                                                class="cart_product_brand_{{ $product->id }}">
                                                            <input type="hidden" value="{{ $product->slug }}"
                                                                class="cart_product_slug_{{ $product->id }}">
                                                            <a class="add-cart-btn AddToCart"
                                                                data-id_product="{{ $product->id }}">
                                                                <i class="icon-basket"></i>
                                                            </a>
                                                            <a class="quick-view-text">
                                                                <i class="icon-eye" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                        <div class="button-row-2">
                                                            <a href="a-gift-of-grace-sympathy-gift-basket.html">
                                                                <i class="icon-link" aria-hidden="true"></i>
                                                            </a>
                                                            <div class="add-to-wishlist">
                                                                <div class="show">
                                                                    <div
                                                                        class="default-wishbutton-a-gift-of-grace-sympathy-gift-basket loading">
                                                                        <a class="add-in-wishlist-js btn"
                                                                            href=""><i
                                                                                class="fa fa-heart-o"></i><span
                                                                                class="tooltip-label">Add to
                                                                                wishlist</span></a>
                                                                    </div>
                                                                    <div class="loadding-wishbutton-a-gift-of-grace-sympathy-gift-basket loading btn"
                                                                        style="display: none; pointer-events: none"><a
                                                                            class="add_to_wishlist"
                                                                            href="a-gift-of-grace-sympathy-gift-basket.html"><i
                                                                                class="fa fa-circle-o-notch fa-spin"></i></a>
                                                                    </div>
                                                                    <div class="added-wishbutton-a-gift-of-grace-sympathy-gift-basket loading"
                                                                        style="display: none;"><a
                                                                            class="added-wishlist btn add_to_wishlist"
                                                                            href="../pages/wishlist.html"><i
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
                                                <div class="product_left">
                                                    <a href="{{ route('ProductDetail', ['slug' => $product->slug]) }}"
                                                        class="grid-link__title">{{ $product->name }}</a>
                                                    <div class="grid-link__meta">
                                                        <div class="product_price">
                                                            <div class="grid-link__org_price">
                                                                <span
                                                                    class=money>{{ $product->sale != 0 ? number_format($product->price - ($product->price * $product->sale) / 100) : number_format($product->price) }}
                                                                    VNĐ</span>
                                                            </div>
                                                            <del
                                                                class="grid-link__sale_price {{ $product->sale == 0 ? 'd-none' : '' }}">
                                                                <span class=money>{{ number_format($product->price) }}
                                                                    VNĐ</span>
                                                            </del>
                                                        </div>
                                                    </div>
                                                    <ul class="item-swatch color_swatch_Value flavour_list">
                                                        @if ($product->tags != null)
                                                            @foreach (explode(',', $product->tags) as $tag)
                                                                <li>
                                                                    <span>
                                                                        <a href="{{ route('Products', ['category' => $tag]) }}"
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
                            @else
                                <p class="border text-center p-3 d-grid">{{ __('Product detail does not exist') }}</p>
                            @endif
                        </ul>
                        <div class="nav_featured"> </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    <div class="dt-sc-hr-invisible-large"></div>
    </main>
    </div>
@endsection
