<div id="shopify-section-1499410839516" class="shopify-section index-section">
    <div data-section-id="1499410839516" data-section-type="filter-grid-type-2" class="filter-grid-type-2">
        <div class="grid-uniform">
            <div class="filter-grid-type-wrapper text-center"
                style="background-image:url('https://cdn.shopify.com/s/files/1/2159/5497/files/bg-pattern.png?v=1613541007');background-position:center;">
                <div class="dt-sc-hr-invisible-large"></div>
                <div class="wrapper">
                    <div class="short-desc" style="color:#585239;">
                        <p>{{ __('Just in now') }}</p>
                    </div>
                    <div class="border-title">
                        <h2 style="color:#bfea20">{{ __('Best Sellers') }}</h2>
                    </div>
                    <div class="grid__item  text-center">
                        <div class="sorting-container">
                            <a style="color:#585239;" data-filter=".all-sort" class="active-all"
                                href="#">{{ __('All') }}</a>
                            @foreach ($brands as $brand)
                                <a style="color:#585239;" data-filter=".{{ $brand->slug }}"
                                    href="#">{{ $brand->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="portfolio-container cs-style-3">
                        @foreach ($food as $item)
                            <div
                                class="column grid__item wide--one-fifth post-large--one-fifth large--one-third medium--one-third small-grid__item  small--grid__item text-center gallery no-space cake {{ $item->brands->slug }} all-sort">
                                <div class="grid__item item-row" id="">
                                    <div class="products wow fadeIn">
                                        <div class="product-container">
                                            <a href="{{ route('ProductDetail', ['slug' => $item->slug]) }}"
                                                class="grid-link">
                                                <div class="featured-tag">
                                                    <span class="badge badge--sale">
                                                        <span
                                                            class="gift-tag badge__text {{ $item->sale == 0 ? 'd-none' : '' }}">
                                                            {{ $item->sale != 0 ? 'Sale' : '' }}
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="ImageOverlayCa"></div>
                                                <img src="{{ $item->image }}" class="featured-image"
                                                    alt="{{ $item->slug }}">
                                            </a>
                                            <div class="ImageWrapper">
                                                <div class="product-button">
                                                    <div class="button-row-1">
                                                        <a type="button" view-id="{{ $item->id }}"
                                                            class="quick-view-text">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                        <a
                                                            href="{{ route('ProductDetail', ['slug' => $item->slug]) }}">
                                                            <i class="fa-solid fa-link"></i>
                                                        </a>
                                                    </div>
                                                    <div class="button-row-2">
                                                        <input type="hidden" value="1"
                                                            class="cart_product_qty_{{ $item->id }}">
                                                        <input type="hidden" value="{{ $item->id }}"
                                                            class="cart_product_id_{{ $item->id }}">
                                                        <input type="hidden" value="{{ $item->name }}"
                                                            class="cart_product_name_{{ $item->id }}">
                                                        <input type="hidden" value="{{ $item->image }}"
                                                            class="cart_product_image_{{ $item->id }}">
                                                        <input type="hidden" value="{{ $item->quantity }}"
                                                            class="cart_product_quantity_{{ $item->id }}">
                                                        <input type="hidden"
                                                            value="{{ $item->price - ($item->price * $item->sale) / 100 }}"
                                                            class="cart_product_price_{{ $item->id }}">
                                                        <input type="hidden" value="{{ $item->brands->name }}"
                                                            class="cart_product_brand_{{ $item->id }}">
                                                        <input type="hidden" value="{{ $item->slug }}"
                                                            class="cart_product_slug_{{ $item->id }}">
                                                        <a class="add-cart-btn AddToCart"
                                                            data-id_product="{{ $item->id }}">
                                                            <i class="icon-basket"></i>
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
                                                                    <input type="hidden" class="product-id"
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
                                            <a href="{{ route('ProductDetail', ['slug' => $item->slug]) }}"
                                                class="grid-link__title">{{ $item->name }}</a>
                                            <div class="grid-link__meta">
                                                <div class="product_price">
                                                    <div class="grid-link__org_price">
                                                        <span
                                                            class=money>{{ $item->sale != 0 ? number_format($item->price - ($item->price * $item->sale) / 100) : number_format($item->price) }}
                                                            VNĐ</span>
                                                    </div>
                                                    <del
                                                        class="grid-link__sale_price {{ $item->sale == 0 ? 'd-none' : '' }}">
                                                        <span class=money>{{ number_format($item->price) }}
                                                            VNĐ</span>
                                                    </del>
                                                </div>
                                                <span class="shopify-product-reviews-badge" data-id=""></span>
                                            </div>
                                            <ul class="item-swatch color_swatch_Value flavour_list">
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
                            </div>
                        @endforeach
                    </div>
                    <div class="dt-sc-hr-invisible-large"></div>
                </div>
            </div>
        </div>
    </div>
</div>
