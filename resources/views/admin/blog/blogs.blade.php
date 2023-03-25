@extends('newAdmin')
@section('title', __('Blog'))
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper justify-content-between align-items-center">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <div>Bài viết
                        <div class="page-title-subheading">Quản lý bài viết</div>
                    </div>
                </div>
                <div class="page-title-icon">
                    <a href="{{ route('CreateBlog') }}"><i class="fa fa-plus"></i></a>
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
                            <th>Tên</th>
                            <th>Nội dung</th>
                            <th>Tác giả</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($blogs) > 0)
                            @foreach ($blogs as $key => $blog)
                                <tr>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <img width="42" height="42" class="rounded-circle"
                                                        src="{{ $blog->image }}" alt="">
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">{{ $blog->name }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{!! $blog->content !!}</td>
                                    <td>{{ $blog->author }}</td>
                                    <td>
                                        <a href="{{ route('EditBlog', ['id' => $blog->id]) }}" class="active"
                                            ui-toggle-class=""><i
                                                class="fa-solid fa-pencil text-success text-active"></i></a>
                                        <a onclick="return confirm('Bạn có muốn xóa?')"
                                            href="{{ route('DeleteBlog', ['id' => $blog->id]) }}" class="active"
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
