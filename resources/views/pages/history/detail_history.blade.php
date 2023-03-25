@section('title', __('History'))
@extends('newLayout')
@section('body')
    <div class="container">
        <div class="table-agile-info">
            <div class="panel-heading">
                {{ __('Personal') }}
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Phone') }}</th>

                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->customer_email }}</td>
                            <td>{{ $customer->customer_phone }}</td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br><br>
        <div class="table-agile-info">
            <div class="panel-heading">
                {{ __('Shipping Information') }}
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>

                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Address') }}</th>
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('Notes') }}</th>
                            <th>{{ __('PaymentMethod') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $shipping->shipping_name }}</td>
                            <td>{{ $shipping->shipping_address }}</td>
                            <td>{{ $shipping->shipping_phone }}</td>
                            <td>
                                @if ($shipping->shipping_notes != null)
                                    {{ $shipping->shipping_notes }}
                                @else
                                    {{ __('Orders without notes') }}
                                @endif
                            </td>
                            <td>
                                @if ($shipping->shipping_method == 0)
                                    {{ __('Payment via Vnpay') }}
                                @elseif ($shipping->shipping_method == 1)
                                    {{ __('Payment on delivery') }}
                                @else
                                    {{ __('Payment via Momo') }}
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br><br>
        <div class="table-agile-info">
            <div class="panel-heading">
                {{ __('Order details') }}
            </div>

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>{{ __('No') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                            $total = 0;
                        @endphp
                        @foreach ($order_details as $key => $ord_d)
                            @php
                                $i++;
                                $subtotal = $ord_d->product_price * $ord_d->product_sales_quantity;
                                $total += $subtotal;
                            @endphp
                            <tr class="color_qty_{{ $ord_d->product_id }}">
                                <td>{{ $i }}</td>
                                <td>{{ $ord_d->product_name }}</td>
                                <td>
                                    <input type="number" min="1" readonly="readonly"
                                        class="order_qty_{{ $ord_d->product_id }}"
                                        value="{{ $ord_d->product_sales_quantity }}" name="product_sale_quantity"
                                        oninput="this.value = Math.abs(this.value)">
                                    <input type="hidden" name="order_qty_storage" id=""
                                        class="order_qty_storage_{{ $ord_d->product_id }}"
                                        value="{{ $ord_d->product->product_quantity }}">
                                    <input type="hidden" name="order_product_id" id="" class="order_product_id"
                                        value="{{ $ord_d->product_id }}">
                                </td>
                                <td>{{ number_format($ord_d->product_price) }} VND</td>
                                <td>{{ number_format($subtotal) }} VND</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>{{ __('Coupon') }}</th>
                            <th colspan="2">{{ __('Method of reduction') }}</th>
                            <th colspan="3">{{ __('Payment') }}</th>
                        </tr>
                        <tr>
                            <td>
                                @if ($ord_d->product_coupon != 'no')
                                    {{ $ord_d->product_coupon }}
                                @else
                                    {{ __('Orders do not apply discount code') }}
                                @endif
                            </td>
                            <td colspan="2">
                                @php
                                    if ($coupon_condition == 1) {
                                        echo 'Discount by %' . '<br>' . $coupon_number . ' %';
                                    } elseif ($coupon_condition == 2) {
                                        echo __('Discount by money') . '<br>' . number_format($coupon_number) . ' VND';
                                    } elseif ($coupon_condition == null) {
                                        echo __('Nothing');
                                    }
                                @endphp
                            </td>
                            <td colspan="2">
                                {{ __('Ship') }} : {{ $ord_d->product_feeship }} VND<br>
                                @php
                                    $total_coupon = 0;
                                @endphp
                                @if ($coupon_condition == 1)
                                    @php
                                        $total_after_coupon = ($total * $coupon_number) / 100;
                                        echo __('Total reduction : ') . number_format($total_after_coupon) . ' VND' . '<br>';
                                        $total_coupon = $total - $total_after_coupon + $ord_d->product_feeship;
                                    @endphp
                                @else
                                    @php
                                        echo __('Total reduction : ') . number_format($coupon_number) . ' VND' . '<br>';
                                        $total_coupon = $total - $coupon_number + $ord_d->product_feeship;
                                    @endphp
                                @endif
                                {{ __('Total') }} : {{ number_format($total_coupon) }} VND
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br><br>
    </div>
@endsection
