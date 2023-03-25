@extends('newAdmin')
@section('title', 'Create Coupon')
@section('content')
    @php
        $oldCoupon = Session::get('oldCoupon');
    @endphp
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper justify-content-between align-items-center">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <div>Mã khuyến mãi
                        <div class="page-title-subheading"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <div class="panel-body">
                        @include('pages.alert.alert')
                        <div class="position-center">
                            <form role="form" action="{{ route('InsertCoupon') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="coupon_name">Tên mã khuyến mãi</label>
                                    <input type="text" name="coupon_name" class="form-control" id="coupon_name"
                                        placeholder="Tên mã khuyến mãi"
                                        value="{{ $oldCoupon ? $oldCoupon['coupon_name'] : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="coupon_code">Mã khuyến mãi</label>
                                    <input type="text" name="coupon_code" class="form-control" id="coupon_code"
                                        placeholder="Mã khuyến mãi"
                                        value="{{ $oldCoupon ? $oldCoupon['coupon_code'] : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="coupon_times">Số lần dùng</label>
                                    <input type="number" name="coupon_times" class="form-control" id="coupon_times"
                                        placeholder="Số lần dùng"
                                        value="{{ $oldCoupon ? $oldCoupon['coupon_times'] : '' }}">
                                </div>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <div class="col-md-6 pl-0">
                                            <label for="exampleInputPassword1">Giảm theo</label>
                                            <select name="coupon_condition" class="form-control input-lg m-bot15">
                                                @foreach ($couponType as $key => $val)
                                                    <option value="{{ $key }}">
                                                        {{ $val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <label for="title">Số giảm</label>
                                            <input type="number" name="coupon_number" class="form-control"
                                                id="coupon_number"
                                                value="{{ $oldCoupon ? $oldCoupon['coupon_number'] : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <div class="col-md-6 pl-0">
                                            <label for="coupon_date_start">Ngày bắt đầu</label>
                                            <input type="date" name="coupon_date_start" class="form-control"
                                                id="coupon_date_start"
                                                value="{{ $oldCoupon ? $oldCoupon['coupon_date_start'] : '' }}">
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <label for="coupon_date_end">Ngày kết thúc</label>
                                            <input type="date" name="coupon_date_end" class="form-control"
                                                id="coupon_date_end"
                                                value="{{ $oldCoupon ? $oldCoupon['coupon_date_end'] : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="accountType">Khách</label>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center">
                                            <input type="checkbox" name="vip" id="vip" class="mr-2"
                                                @if (isset($oldCoupon['vip']) && $oldCoupon['vip'] == true) checked @endif>Khách
                                            Vip
                                        </div>
                                        <div class="ml-4 d-flex align-items-center">
                                            <input type="checkbox" name="normal" id="normal" class="mr-2"
                                                @if (isset($oldCoupon['normal']) && $oldCoupon['normal'] == true) checked @endif>Khách
                                            bình thường
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="status" class="form-control input-lg m-bot15">
                                        @foreach ($status as $key => $val)
                                            <option value="{{ $key }}">
                                                {{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" name="add_category" class="btn btn-info">Lưu</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    @endsection
