@section('title', __('Account'))
@extends('newLayout')
@section('scripts')
    {!! Html::script('public/assets/js/client/account/account.js') !!}
    {!! Html::script('public/assets/js/client/account/account-tab.js') !!}
@stop
@section('body')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <h1>{{ __('Account') }}</h1>
        <a href="/" title="Back to the frontpage">{{ __('Home') }}</a>
        <span aria-hidden="true" class="breadcrumb__sep">/</span>
        <span>{{ __('Account') }}</span>
    </nav>
    <main class="main-content">
        <div class="dt-sc-hr-invisible-large"></div>
        <div class="wrapper">
            <div class="grid__item">
                <div class="order-form d-flex">
                    <div class="tab col-md-3">
                        <button class="tablinks mb-0" onclick="openCity(event, 'London')"
                            id="defaultOpen">{{ __('Profile') }}</button>
                        <button class="tablinks mb-0"
                            onclick="openCity(event, 'Paris')">{{ __('Purchase history') }}</button>
                        {{-- <button class="tablinks mb-0" onclick="openCity(event, 'Tokyo')">Tokyo</button> --}}
                        <a href="{{ route('Logout') }}"><button class="tablinks mb-0">{{ __('Logout') }}</button></a>
                    </div>

                    <div class="col-md-9">
                        <div id="London" class="tabcontent">
                            <div class="grid__item mt-3">
                                <div class="text-left">
                                    <form method="post"
                                        action="{{ route('EditCustomer', ['id' => $account->customer_id]) }}"
                                        id="account-form" accept-charset="UTF-8">
                                        <div id="AddAddress" style="" class="text-left">
                                            <div class="grid__item">
                                                <label for="customer_name">{{ __('Name') }}</label>
                                                <input type="text" class="address_form" id="customer_name"
                                                    name="customer_name" value="{{ $account['customer_name'] }}"
                                                    autocapitalize="words">
                                            </div>
                                            <div class="grid__item">
                                                <label for="customer_email">{{ __('Email') }}</label>
                                                <input type="text" id="customer_email" class="address_form"
                                                    value="{{ $account['customer_email'] }}" autocapitalize="words"
                                                    disabled>
                                            </div>
                                            <div class="grid__item">
                                                <label for="customer_phone">{{ __('Phone') }}</label>
                                                <input type="tel" class="address_form" id="customer_phone"
                                                    name="customer_phone" value="{{ $account['customer_phone'] }}"
                                                    autocapitalize="words">
                                            </div>
                                            <div class="grid__item">
                                                <label for="customer_address">{{ __('Address') }}</label>
                                                <input type="text" class="address_form" id="customer_address"
                                                    name="customer_address" value="{{ $account['customer_address'] }}"
                                                    autocapitalize="words">
                                            </div>
                                            <input type="button" class="btn" id="btn-save"
                                                value="{{ __('Save') }}">
                                            <hr>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div id="Paris" class="tabcontent">
                            <div class="grid__item">
                                @if (count($historyOrder) > 0)
                                    <div class="cart__row cart__header-labels">
                                        <div class="grid--full">
                                            <div
                                                class="grid__item post-large--seven-tenths large--seven-tenths medium--grid__item">
                                                <div class="grid--full">
                                                    <div
                                                        class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-fifth">
                                                        <span class="h4 cart__mini-labels">{{ __('Order code') }}</span>
                                                    </div>
                                                    <div
                                                        class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-fifth">
                                                        <span class="h4 cart__mini-labels">{{ __('Date') }}</span>
                                                    </div>
                                                    <div
                                                        class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-fifth">
                                                        <span class="h4 cart__mini-labels">{{ __('Order status') }}</span>
                                                    </div>
                                                    <div
                                                        class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-fifth">
                                                        <span class="h4 cart__mini-labels">{{ __('Order detail') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($historyOrder as $order)
                                        <div class="cart__row">
                                            <div class="grid--full cart__row--table-large">
                                                <div
                                                    class="grid__item post-large--seven-tenths large--seven-tenths medium--grid__item">
                                                    <div class="grid--full cart__row--table-large">
                                                        <div
                                                            class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-quarter small--one-quarter">
                                                            <span
                                                                class="h5 cart__large-labels">{{ __('Order code') }}</span>
                                                            <span class="h5"><span
                                                                    class="money">{{ $order->order_code }}</span></span>
                                                        </div>
                                                        <div
                                                            class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-quarter small--one-quarter text-center">
                                                            <span class="h5 cart__large-labels">{{ __('Date') }}</span>
                                                            <span class="h5"><span
                                                                    class="money">{{ $order->created_at }}</span></span>
                                                        </div>
                                                        <div
                                                            class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-quarter small--one-quarter text-center">
                                                            <span
                                                                class="h5 cart__large-labels">{{ __('Order status') }}</span>
                                                            <span class="h5">
                                                                <span class="money">
                                                                    @if ($order->order_status == 1)
                                                                        {{ __('Orders Are Being Processed') }}
                                                                    @elseif ($order->order_status == 2)
                                                                        {{ __('Order processed successfully') }}
                                                                    @else
                                                                        {{ __('Order canceled') }}
                                                                    @endif
                                                                </span>
                                                            </span>
                                                        </div>
                                                        <div
                                                            class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-quarter small--one-quarter text-center">
                                                            <span
                                                                class="h5 cart__large-labels">{{ __('Order detail') }}</span>
                                                            <span class="h5">
                                                                <span class="money">
                                                                    <a class="btn"
                                                                        href="{{ route('OrderDetail', ['order_code' => $order->order_code]) }}">{{ __('Detail') }}</a>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{ $historyOrder->appends(request()->input())->links() }}
                                @else
                                    <p class="border text-center p-3">{{ __("You haven't placed any orders yet.") }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- <div id="Tokyo" class="tabcontent">
                            <h3>Tokyo</h3>
                            <p>Tokyo is the capital of Japan.</p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="dt-sc-hr-invisible-large"></div>

    </main>
    {{-- <div class="container">
        <div id="shipping-address" class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#shipping-address-content"
                        class="accordion-toggle" aria-expanded="true">
                        Tài khoản
                    </a>
                </h2>
            </div>
            <div id="shipping-address-content" class="panel-collapse collapse in" aria-expanded="true" style="">
                <div class="panel-body">
                    <form action="{{ URL::to('edit-customer/' . Session::get('customer_id')) }}" method="POST">
                        @csrf
                        <div class="col-md-6 col-sm-6">
                            @if ($account->customer_picture)
                                <img src="{{ $account->customer_picture }}" alt="" width="100%">
                            @else
                                <img src="data:image/jpeg;base64,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"
                                    alt="" width="100%">
                            @endif
                            <input type="file" name="customer_picture">
                        </div>
                        <div class="d-flex">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="address2-dd">Email</label>
                                    <input type="text" id="address2-dd" class="form-control"
                                        value="{{ $account->customer_email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="address1-dd">Họ tên</label>
                                    <input type="text" id="address1-dd" class="form-control"
                                        value="{{ $account->customer_name }}" name="customer_name">
                                </div>
                                <div class="form-group">
                                    <label for="city-dd">Số điện thoại <span class="require">*</span></label>
                                    <input type="text" id="city-dd" class="form-control"
                                        value="{{ $account->customer_phone }}" name="customer_phone">
                                </div>
                            </div>
                            <div class="">
                                <button class="btn btn-primary  pull-right collapsed" type="submit"
                                    name="EditCustomer">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
