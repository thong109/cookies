@section('title', __('Cookie Crumble'))
@extends('newLayout')
@section('body')
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
                                <a style="color:#585239;" data-filter=".all-sort" class="active-all" href="#">All</a>
                                @foreach ($category as $category)
                                    <a style="color:#585239;" data-filter=".{{ $category->category_slug }}"
                                        href="#">{{ $category->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="portfolio-container cs-style-3">
                            @foreach ($food as $item)
                                <div
                                    class="column grid__item wide--one-fifth post-large--one-fifth large--one-third medium--one-third small-grid__item  small--grid__item text-center gallery no-space {{ $item->category_id }}  cake  all-sort">
                                    <div class="grid__item item-row" id="">
                                        <div class="products wow fadeIn">
                                            <div class="product-container">
                                                <a href="" class="grid-link">
                                                    <div class="featured-tag">
                                                        <span class="badge badge--sale">
                                                            <span class="gift-tag badge__text">
                                                                {{ $item->sale != 0 ? __('Sale') : null }}
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
                                                <a href="" class="grid-link__title">{{ $item->name }}</a>
                                                <div class="grid-link__meta">
                                                    <div class="product_price">
                                                        <div class="grid-link__org_price">
                                                            <span
                                                                class=money>{{ $item->sale != 0 ? number_format($item->regular_price - ($item->regular_price * $item->sale) / 100) : number_format($item->regular_price) }}
                                                                VNĐ</span>
                                                        </div>
                                                        <del class="grid-link__sale_price"><span
                                                                class=money>{{ number_format($item->regular_price) }}
                                                                VNĐ</span></del>
                                                    </div>
                                                    <span class="shopify-product-reviews-badge" data-id=""></span>
                                                </div>
                                                <ul class="item-swatch color_swatch_Value flavour_list">
                                                    @if ($item->keywords != null)
                                                        @foreach (explode(',', $item->keywords) as $tag)
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
                        <div class="dt-sc-hr-invisible-large"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
