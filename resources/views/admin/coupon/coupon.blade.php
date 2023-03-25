@extends('newAdmin')
@section('title', __('Coupon'))
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper justify-content-between align-items-center">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <div>Mã khuyến mãi
                        <div class="page-title-subheading">Quản lý mã khuyến mãi</div>
                    </div>
                </div>
                <div class="page-title-icon">
                    <a href="{{ route('CreateCoupon') }}"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="table-agile-info">
            @include('pages.alert.alert')
            <div class="table-responsive">
                <table class="mb-0 table table-bordered">
                    <thead>
                        <tr>
                            <th>Tên mã giảm giá</th>
                            <th>Mã giảm giá</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Số lần dùng</th>
                            <th>Loại mã giảm</th>
                            <th>Tình trạng</th>
                            <th>Gửi mã</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($coupons) > 0)
                            @foreach ($coupons as $key => $coupon)
                                <tr>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">{{ $coupon->coupon_name }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $coupon->coupon_code }}</td>
                                    <td>{{ date('d-m-Y', $coupon->coupon_date_start) }}</td>
                                    <td>{{ date('d-m-Y', $coupon->coupon_date_end) }}</td>
                                    <td>{{ $coupon->coupon_times }}</td>
                                    <td>
                                        {{ $coupon->coupon_condition == 2
                                            ? number_format($coupon->coupon_number) . ' VND'
                                            : $coupon->coupon_number . ' %' }}
                                    </td>
                                    <td>
                                        {{ $coupon->coupon_date_end > $now ? 'Còn hạn' : 'Hết hạn' }}
                                    </td>
                                    <td>
                                        @if ($coupon->coupon_status == 1)
                                            @if ($coupon->coupon_date_end > $now)
                                                @if ($coupon->customer_vip == true && $coupon->customer_normal == false)
                                                    <a href="{{ route('CouponVip', [
                                                        'coupon' => $coupon,
                                                    ]) }}"
                                                        class="text-dark">Cho khách vip</a>
                                                @elseif ($coupon->customer_normal == true && $coupon->customer_vip == false)
                                                    <a href="{{ URL::to('/send-coupon', [
                                                        'coupon' => $coupon,
                                                    ]) }}"
                                                        class="text-dark">Cho khách thường</a>
                                                @elseif ($coupon->customer_vip == true && $coupon->customer_normal == true)
                                                    <div class="d-flex flex-column">
                                                        <a href="{{ route('CouponVip', [
                                                            'coupon' => $coupon,
                                                        ]) }}"
                                                            class="text-dark">Cho khách vip</a>
                                                        <a href="{{ URL::to('/send-coupon', [
                                                            'coupon' => $coupon,
                                                        ]) }}"
                                                            class="text-dark">Cho khách thường</a>
                                                    </div>
                                                @endif
                                            @else
                                                <span>Hết hạn</span>
                                            @endif
                                        @else
                                            Vô hiệu
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            <a href="{{ route('ChangeStatusOfCoupon', ['id' => $coupon->coupon_id]) }}">
                                                <span
                                                    class="fa-solid fa-eye{{ $coupon->coupon_status == 0 ? '-slash' : '' }}"></span>
                                            </a>
                                        </span>
                                        <a onclick="return confirm('Bạn có muốn xóa?')"
                                            href="{{ route('DeleteCoupon', ['id' => $coupon->coupon_id]) }}" class="active"
                                            ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">Không có dữ liệu</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
