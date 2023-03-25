@extends('newAdmin')
@section('title', __('Customer'))
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper justify-content-between align-items-center">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <div>Khách hàng
                        <div class="page-title-subheading">Quản lý khách hàng</div>
                    </div>
                </div>
                <div class="page-title-icon">
                    <a href="{{ route('CreateCustomer') }}"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="table-agile-info">
            @include('pages.alert.alert')
            <div class="table-responsive">
                <table class="mb-0 table table-bordered">
                    <thead>
                        <tr>
                            <th>Khách hàng</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Thông tin đặt hàng</th>
                            <th>Vip</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <img width="42" height="42" class="rounded-circle"
                                                    src="{{ $customer->customer_picture != '' ? $customer->customer_picture : '/camera/public/imgs/default.png' }}"
                                                    alt="">
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">{{ $customer->customer_name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $customer->customer_email }}</td>
                                <td>{{ $customer->customer_phone }}</td>
                                <td>{{ $customer->customer_address }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div>
                                            Số đơn hàng đã mua : {{ $customer->totalOrder }}
                                        </div>
                                        <div>
                                            Số tiền đã chi :
                                            {{ $customer->totalPrice != null ? number_format($customer->totalPrice) . ' VNĐ' : '0' . ' VNĐ' }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-ellipsis">
                                        <a href="{{ route('ChangeStatusOfCustomer', ['id' => $customer->customer_id]) }}">
                                            <span
                                                class="fa-solid fa-{{ $customer->customer_vip == 0 ? 'crown' : 'user' }}"></span>
                                        </a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
