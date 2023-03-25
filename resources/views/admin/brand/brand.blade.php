@extends('newAdmin')
@section('title', __('Brand'))
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper justify-content-between align-items-center">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <div>Danh mục
                        <div class="page-title-subheading">Quản lý danh mục</div>
                    </div>
                </div>
                <div class="page-title-icon">
                    <a href="{{ route('CreateBrand') }}"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="table-agile-info">
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
            <div class="table-responsive">
                <table class="mb-0 table table-bordered">
                    <thead>
                        <tr>
                            <th>Danh mục</th>
                            <th>Nội dung</th>
                            <th>Hiển thị</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $key => $danhmuc)
                            <tr>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">{{ $danhmuc->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="thugon">{!! $danhmuc->description !!}</td>
                                <td>
                                    <span class="text-ellipsis">
                                        <a href="{{ route('ChangeStatusOfBrand', ['id' => $danhmuc->id]) }}">
                                            <span class="fa-solid fa-eye{{ $danhmuc->status == 0 ? '-slash' : '' }}"></span>
                                        </a>
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('EditBrand', ['id' => $danhmuc->id]) }}" class="active"
                                        ui-toggle-class=""><i class="fa-solid fa-pencil text-success text-active"></i></a>
                                    <a onclick="return confirm('Bạn có muốn xóa?')"
                                        href="{{ route('DeleteBrand', ['id' => $danhmuc->id]) }}" class="active"
                                        ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
