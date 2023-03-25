@extends('newAdmin')
@section('title', __('Order'))
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper justify-content-between align-items-center">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <div>Đơn hàng
                        <div class="page-title-subheading">Quản lý đơn hàng</div>
                    </div>
                </div>
                <div class="page-title-icon">
                    <a href="{{ route('CreateCustomer') }}"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        @include('pages.alert.alert')
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tình trạng đơn hàng</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($orders as $key => $or)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $or->order_code }}</td>
                            <td>{{ $or->created_at }}</td>
                            <td>
                                {{ $or->order_status == 1 ? 'Đơn hàng mới' : 'Đã xong' }}
                            </td>
                            <td>
                                <a href="{{ URL::to('/view-order/' . $or->order_code) }}" class="active"
                                    ui-toggle-class=""><i class="fa fa-eye text-success text-active"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
