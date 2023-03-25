@section('title', 'Your Shopping Cart')

@section('scripts')
    <script>
        const urls = {
            fetchCart: '{{ route('FetchCart') }}',
            deleteCart: '{{ route('DeleteCart') }}',
            productDetail: '{{ route('ProductDetail', '') }}',
            updateCart: '{{ route('UpdateCart') }}',
            home: '{{ route('Home') }}',
            checkout: '{{ route('Checkout') }}',
            checkCoupon: '{{ route('CheckCoupon') }}',
            delCoupon: '{{ route('DelCoupon') }}',
        };
    </script>
    {!! Html::script('public/assets/js/client/cart/cart.js') !!}
@stop
@extends('newLayout')
@section('body')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <h1>{{ __('Your Shopping Cart') }}</h1>
        <a href="{{ route('Home') }}" title="Back to the frontpage">{{ __('Home') }}</a>
        <span aria-hidden="true" class="breadcrumb__sep">/</span>
        <span>{{ __('Your Shopping Cart') }}</span>
    </nav>
    <main class="main-content">
        <div class="dt-sc-hr-invisible-large"></div>
        <div class="wrapper">
            <div class="grid__item">
                <div class="cart__row cart__header-labels">
                    <div class="grid--full">
                        <div
                            class="grid__item wide--three-tenths post-large--three-tenths large--three-tenths medium--grid__item">
                            <div class="grid">
                                <div class="grid__item">

                                    <span class="h4">{{ __('Product') }}</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="grid__item wide--seven-tenths post-large--seven-tenths large--seven-tenths medium--grid__item">
                            <div class="grid--full">
                                <div
                                    class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-fifth">
                                    <span class="h4 cart__mini-labels">{{ __('Price') }}</span>
                                </div>
                                <div
                                    class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-fifth">
                                    <span class="h4 cart__mini-labels">{{ __('Quantity') }}</span>
                                </div>
                                <div
                                    class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-fifth">
                                    <span class="h4 cart__mini-labels">{{ __('Total') }}</span>
                                </div>
                                <div
                                    class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-fifth">
                                    <span class="h4 cart__mini-labels">{{ __('Remove') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="allCart">
                </div>
            </div>
        </div>
        <div class="dt-sc-hr-invisible-large"></div>

    </main>
@endsection
