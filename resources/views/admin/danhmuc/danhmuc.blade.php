@extends('newAdmin')
@section('title', __('Category'))
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
                    <a href="{{ route('CreateCategory') }}"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="table-agile-info">
            @include('pages.alert.alert')
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
                        @foreach ($danhmucs as $key => $danhmuc)
                            <tr>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <img width="42" height="42" class="rounded-circle"
                                                    src="{{ $danhmuc->image }}" alt="">
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">{{ $danhmuc->name }}</div>
                                                <div class="widget-subheading">{{ $danhmuc->title }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{!! $danhmuc->description !!}</td>
                                <td>
                                    <span class="text-ellipsis">
                                        <a href="{{ route('ChangeStatusOfCategory', ['id' => $danhmuc->id]) }}">
                                            <span class="fa-solid fa-eye{{ $danhmuc->status == 0 ? '-slash' : '' }}"></span>
                                        </a>
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('EditCategory', ['id' => $danhmuc->id]) }}" class="active"
                                        ui-toggle-class=""><i class="fa-solid fa-pencil text-success text-active"></i></a>
                                    <a onclick="return confirm('Bạn có muốn xóa?')"
                                        href="{{ route('DeleteCategory', ['id' => $danhmuc->id]) }}" class="active"
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
