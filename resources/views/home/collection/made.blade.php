@extends('layouts.app')
@section('title', __('Collections - Cookie Crumble'))
@section('body')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <h1>Biscuits</h1>
        <a href="index.html" title="Back to the frontpage">Home</a>
        <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>
        <span>Biscuits</span>
    </nav>
    <main class="main-content">
        <div class="dt-sc-hr-invisible-large"></div>
        <div class="wrapper">
            <div class="grid__item">
                <div class="grid-uniform list-collection-products">
                    @foreach ($categories as $category)
                        <div
                            class="grid__item grid__item wide--one-third post-large--one-third large--one-third medium--one-half small--grid__item text-center pickgradient-products">
                            <a href="{{ route('Collection', ['slug' => $category->slug]) }}" title="Browse our Cookies collection"
                                class="pickgradient grid-link">
                                <img src="https://cdn.shopify.com/s/files/1/2159/5497/products/cookie24_large.jpg?v=1500098999"
                                    alt="Cookies" />
                                <div class="dt-sc-event-overlay">
                                    <p class="collection-count">{{ count($category->products()->get()) }}<span>Items</span>
                                    </p>
                                </div>
                            </a>
                            <a href="collections/cookies.html" title="Browse our Cookies collection" class="grid-link">
                                <span class="grid-link__title">{{ $category->name }}</span></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="dt-sc-hr-invisible-large"></div>
    </main>
@stop
