@section('title', 'Checkout')
@extends('layoutCheckout')
@section('scripts')
    <script>
        const urls = {
            fetchDelivery: '{{ route('FetchDelivery') }}',
            caculateFee: '{{ route('CaculateFee') }}',
            fetchTotal: '{{ route('FetchTotal') }}',
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
                            <form method="POST">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="exampleInputPassword1"
                                            class="form-label">{{ __('Choose a district') }}</label>
                                        <input type="email" value="{{ Session::get('customer')['customer_email'] }}"
                                            name="shipping_email" class="shipping_email form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="lastname-dd">{{ __('Name') }}<span
                                                class="require">*</span></label>
                                        <input type="text" value="{{ Session::get('customer')['customer_name'] }}"
                                            name="shipping_name" class="form-control shipping_name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="email-dd">{{ __('Address') }}<span
                                                class="require">*</span></label>
                                        <input type="text" value="{{ Session::get('customer')['customer_address'] }}"
                                            name="shipping_address" class="shipping_address form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="telephone-dd">{{ __('Phone') }} <span
                                                class="require">*</span></label>
                                        <input type="text" value="{{ Session::get('customer')['customer_phone'] }}"
                                            name="shipping_phone" class="shipping_phone form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="fax-dd">{{ __('Notes') }}</label>
                                        <textarea type="text" placeholder="{{ __('Notes') }}" name="shipping_notes" class="form-control shipping_notes"></textarea>
                                    </div>
                                    @if (Session::get('fee'))
                                        <input type="hidden" name="order_fee" class="order_fee"
                                            value="{{ Session::get('fee') }}">
                                    @else
                                        <input type="hidden" name="order_fee" class="order_fee" value="30000">
                                    @endif
                                    @if (Session::get('coupon'))
                                        @foreach (Session::get('coupon') as $key => $cou)
                                            <input type="hidden" name="order_coupon" class="order_coupon"
                                                value="{{ $cou['coupon_code'] }}">
                                        @endforeach
                                    @else
                                        <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                                    @endif
                                    <input type="hidden" value="1" name="shipping_method" class="shipping_method">
                                </div>
                            </form>
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
                <div class="d-flex content-center">
                    <div class="">
                        <a class="btn btn-secondary" id="send_order">{{ __('Payment') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
