@section('title', 'Checkout')
@extends('layoutCheckout')
@section('scripts')
    <script>
        const urls = {
            fetchDelivery: '{{ route('FetchDelivery') }}',
            caculateFee: '{{ route('CaculateFee') }}',
            fetchTotal: '{{ route('FetchTotal') }}',
            // vnPay: '{{ route('VnPay') }}',
            checkFee: '{{ route('CheckFee') }}',
            confirmOrder: '{{ route('ConfirmOrder') }}',
        };
    </script>
    {!! Html::script('public/assets/js/admin/delivery/delivery-list.js') !!}
    {!! Html::script('public/assets/js/client/checkout/checkout.js') !!}
@stop

@section('bodyCheckout')
    <div class="d-flex content-center">
        <div class="w-90 d-flex">
            <div class="w-55 left">
                <header>
                    <h4><a href="" class="text-dark">Cookie Crumble | Shopify</a></h4>
                </header>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white p-0">
                        <li class="breadcrumb-item"><span class="">{{ __('Cart') }}</span></li>
                        <li class="breadcrumb-item active"><span>{{ __('Information') }}</span></li>
                        <li class="breadcrumb-item"><span>{{ __('Shipping') }}</span></li>
                    </ol>
                </nav>
                <div>
                    <div>
                        <div>
                            <h5>{{ __('Contact information') }}</h5>
                            <div class="d-flex my-3">
                                <span>{{ $customer['customer_name'] }}</span>
                                <span class="ms-2">({{ $customer['customer_email'] }})</span>
                            </div>
                            <div>
                                <a href="{{ route('Logout') }}">{{ __('Log out') }}</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <h5>{{ __('Shipping address') }}</h5>
                            <span
                                class="mb-2 d-block">{{ __('( You should enter your address to continue paying )') }}</span>
                            <div class="form-group mb-3">
                                <label for="exampleInputPassword1" class="form-label">{{ __('Choose the city') }}</label>
                                <select name="city" id="city" class="form-control city choose ">
                                    <option value="">--- {{ __('Choose the city') }} ---</option>
                                    @foreach ($city as $key => $c_t)
                                        <option value="{{ $c_t->matp }}">{{ $c_t->name_city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputPassword1" class="form-label">{{ __('Choose a district') }}</label>
                                <select name="province" id="province" class="form-control province choose ">
                                    <option value="">--- {{ __('Choose a district') }} ---</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputPassword1" class="form-label">{{ __('Choose a commune') }}</label>
                                <select name="wards" id="wards" class="form-control wards">
                                    <option value="">--- {{ __('Choose a commune') }} ---</option>
                                </select>
                            </div>
                            <input type="button" value="{{ __('ShippingCharges') }}" name="caculate_order"
                                class="btn btn-primary  pull-right collapsed caculate_delivery">
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-45 border-left left">
                <div class="">
                    @foreach ($carts as $cart)
                        <div class="d-flex items-center mt-3">
                            <div class="w-20 d-flex items-center">
                                <img src="{{ $cart['product_image'] }}" alt="" class="img-text">
                            </div>
                            <div class="w-65">
                                <p class="fs-16 name_title">{{ $cart['product_name'] . ' x ' . $cart['product_qty'] }}</p>
                                <div class="">
                                    <p class="fs-14 name_desc">{{ $cart['product_brand'] }}</p>
                                </div>
                            </div>
                            <div class="w-15">
                                <div>
                                    <div class="text-end">
                                        <span>{{ number_format($cart['product_price'] * $cart['product_qty']) . ' đ' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mb-2"></div>
                <hr>
                <div class="" id="totalCheckout">
                </div>
                <div class="d-flex content-between">
                    <div class="">
                        <a class="btn btn-secondary" id="payment-href"
                            href="{{ route('Pay') }}">{{ __('Payment') }}</a>
                    </div>
                    <div class="">
                        <a class="btn btn-secondary" id="vnPay-href" href="{{ route('VnPay') }}">VnPay</a>
                    </div>
                    <div class="">
                        <a class="btn btn-secondary" name="payUrl" id="momo-href" href="{{ route('Momo') }}">Momo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
