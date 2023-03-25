@section('title', 'Wishlist')
@extends('newLayout')

@section('scripts')
    <script>
        const urls = {
            fetchWishlist: '{{ route('FetchWishlist') }}',
            productDetail: '{{ route('ProductDetail', '') }}',
            deleteWishlist: '{{ route('DeleteWishlist') }}',
        };
    </script>
    {!! Html::script('public/assets/js/client/wishlist/wishlist.js') !!}
@stop

@section('body')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <h1>{{ __('Wishlist') }}</h1>
        <a href="{{ route('Home') }}" title="Back to the frontpage">{{ __('Home') }}</a>
        <span aria-hidden="true" class="breadcrumb__sep">/</span>
        <span>{{ __('Wishlist') }}</span>
    </nav>
    <main class="main-content">
        <div class="dt-sc-hr-invisible-large"></div>
        <div class="wrapper">

            <div class="grid__item">
                <div class="jas-container">
                    <div class="table-wrapper">
                        <table class="shop_table cart wishlist_table">
                            <thead>
                                <tr>
                                    <th class="product-remove">{{ __('Remove') }}</th>
                                    <th class="product-thumbnail">{{ __('Image') }}</th>
                                    <th class="product-name"><span class="nobr">{{ __('Product Name') }}</span></th>
                                    <th class="product-price"> <span class="nobr">{{ __('Unit Price') }}</span></th>
                                    <th class="product-stock-stauts"> <span class="nobr">{{ __('Stock status') }}</span>
                                    </th>
                                    <th class="product-add-to-cart"></th>
                                </tr>
                            </thead>
                            <tbody class="wishlist-box">
                            </tbody>

                        </table>
                    </div>
                    <div class="wishlist-item-clear" style="display:none">
                        <a href="#" class="remove remove_from_wishlist product-remove-js"
                            title="Remove this product">×</a>
                    </div>
                    <div class="wishlist-item" style="display:none">
                        <a class="wishlist-item-link" href="#">
                            <!-- img -->
                            <img class="img-responsive" src="#" alt="">
                        </a>
                    </div>
                    <span class="table-wishlist-1__product-price" style="display:none">#</span>
                    <!-- /img -->
                    <div class="wishlist-item-name" style="display:none">
                        <a class="wishlist-item-link" href="#">#</a>
                    </div>
                    <div class="wishlist-stock" style="display:none">
                        <span class="wishlist-in-stock">#</span>
                    </div>
                    <div class="wishlist-item-continue" style="display:none">
                        <a class="button wishlist-item-link btn" href="#" rel="nofollow">#</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="dt-sc-hr-invisible-large"></div>
    </main>
    {{-- <div class="container">
        <h2 class="text-center mb-2">Có tất cả {{ count($wishlists) }} sản phẩm</h2>
        <div class="block-element product-item-1 product-grid-view  default js-content-wrap">
            <div class="products row list-product-wrap js-content-main">
                @foreach ($wishlists as $wishlist)
                    <div
                        class="list-col-item list-4-item post-48252 product type-product status-publish has-post-thumbnail cat-samoyed cat-danh-muc-cun first instock shipping-taxable purchasable product-type-simple">
                        <div class="item-product item-product-grid">
                            <div class="product-thumb">
                                <!-- s7upf_woocommerce_thumbnail_loop have $size and $animation -->
                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $wishlist->wishlist->slug) }}"
                                    class="product-thumb-link zoom-thumb">
                                    <img width="270" height="270"
                                        src="{{ URL::to('public/uploads/product/' . $wishlist->wishlist->image) }}"
                                        class="attachment-270x270 size-270x270 wp-post-image"
                                        sizes="(max-width: 270px) 100vw, 270px" style="width:270px;height:270px">
                                </a>
                                @if ($wishlist->wishlist->sale)
                                    <div class="product-label"><span class="new">sale</span></div>
                                @endif
                                <div class="product-extra-link text-center">
                                    <ul class="list-product-extra-link list-inline-block">
                                        <li><a href="{{ URL::to('add-wishlist/' . $wishlist->wishlist->id) }}"
                                                style="display: flex;justify-content: center;align-items: center;"
                                                class="add_to_wishlist wishlist-link"
                                                data-product-title="{{ $wishlist->wishlist->content }}"><i
                                                    class="pegk pe-7s-like"></i><span>Yêu
                                                    thích</span></a></li>
                                        <li><a title="Xem nhanh"
                                                href="{{ URL::to('/chi-tiet-san-pham/' . $wishlist->wishlist->slug) }}"
                                                style="display: flex;justify-content: center;align-items: center;"
                                                class="product-quick-view quickview-link "><i
                                                    class="pegk pe-7s-search"></i><span>Xem
                                                    nhanh</span></a></li>
                                        <li></li>
                                    </ul>
                                    <input type="hidden" name="productid_hidden" value="{{ $wishlist->wishlist->id }}">
                                    <form action="">
                                        @csrf
                                        <input type="hidden" value="{{ $wishlist->wishlist->id }}"
                                            class="cart_id_{{ $wishlist->wishlist->id }}">
                                        <input type="hidden" id="wistlist_productname{{ $wishlist->wishlist->id }}"
                                            value="{{ $wishlist->wishlist->name }}"
                                            class="cart_name_{{ $wishlist->wishlist->id }}">
                                        <input type="hidden" value="{{ $wishlist->wishlist->image }}"
                                            class="cart_image_{{ $wishlist->wishlist->id }}">
                                        <input type="hidden" value="{{ $wishlist->wishlist->quantity }}"
                                            class="cart_quantity_{{ $wishlist->wishlist->id }}">
                                        @php
                                            $wishlist->wishlist->sale_after = $wishlist->wishlist->price - ($wishlist->wishlist->price * $wishlist->wishlist->sale) / 100;
                                        @endphp
                                        <input type="hidden" id="wistlist_productprice{{ $wishlist->wishlist->id }}"
                                            value="{{ $wishlist->wishlist->sale_after }}"
                                            class="cart_sale_after_{{ $wishlist->wishlist->id }}">
                                        <input type="hidden" class="cart_qty_{{ $wishlist->wishlist->id }}"
                                            name="cart_quantity" min="1" oninput="validity.valid||(value='');"
                                            value="1">
                                        <input type="hidden" name="productid_hidden"
                                            value="{{ $wishlist->wishlist->id }}">
                                    </form>
                                    <?php if ($wishlist->wishlist->quantity > 0) { ?>
                                    <a type="button" data-id_product="{{ $wishlist->wishlist->id }}" name="add-to-cart"
                                        class="add-to-cart button addcart-link shop-button bg-color"
                                        style="cursor: pointer"><span style="color: #fff">{{ __('AddToCart') }}</span></a>
                                    <?php } else { ?>
                                    <a type="button" href="javascript:;"
                                        class="button addcart-link shop-button bg-color add_to_cart_button s7upf_ajax_add_to_cart"
                                        style="text-decoration: none"><span>{{ __('SoldOff') }}</span></a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="product-info">
                                <span class="title12 text-uppercase color font-bold">ID:
                                    {{ strtoupper($wishlist->wishlist->code) }}</span>
                                <h3 class="title18 text-uppercase product-title dosis-font font-bold">
                                    <a title="{{ $wishlist->wishlist->content }}"
                                        href="{{ URL::to('/chi-tiet-san-pham/' . $wishlist->wishlist->slug) }}"
                                        class="black">{{ $wishlist->wishlist->name }}</a>
                                </h3>
                                <div class="product-price simple">
                                    @if ($wishlist->wishlist->sale)
                                        <span
                                            class="woocommerce-Price-amount amount">{{ number_format($wishlist->wishlist->sale_after) }}<span
                                                class="woocommerce-Price-currencySymbol">&#8363;</span></span>
                                        <strike class="woocommerce-Price-amount amount"
                                            style="color: #de8ebe;
                                                                                    font-weight: 700;
                                                                                    font-size: 18px;">
                                            {{ number_format($wishlist->wishlist->price) }}
                                            <span class="woocommerce-Price-currencySymbol">&#8363;</span>
                                        </strike>
                                    @else
                                        <span
                                            class="woocommerce-Price-amount amount">{{ number_format($wishlist->wishlist->price) }}<span
                                                class="woocommerce-Price-currencySymbol">&#8363;</span></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> --}}
@endsection
