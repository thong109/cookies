@extends('newAdmin')
@section('title', $isInsert ? 'Create Blog' : 'Edit Blog')
<script src="http://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper justify-content-between align-items-center">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <div>Bài viết
                        <div class="page-title-subheading"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form"
                                action="{{ $isInsert ? route('InsertBlog') : route('UpdateBlog', $blog->id) }}"
                                id="form-product" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tên bài viết</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ $isInsert == true ? '' : $blog->name }}" placeholder="Tên bài viết">
                                    <input type="hidden" id="id" value="{{ $isInsert ? '' : $blog->id }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Hình ảnh</label>
                                    <input type="file" name="image" class="form-control" id="image"
                                        accept="image/*">
                                    <img src="{{ $isInsert ? '/camera/public/imgs/default.png' : $blog->image }}"
                                        id="img-tag" width="250px" height="250px" class="pt-3 defaul m-auto d-block" />
                                </div>
                                <div class="form-group">
                                    <label for="ckeditor_desc">Nội dung bài viết</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="content" id="content"
                                        value="{{ $isInsert ? '' : $blog->content }}">
                                       {{ $isInsert ? '' : $blog->content }}
                                    </textarea>
                                    <script>
                                        CKEDITOR.replace('content');
                                    </script>
                                </div>
                                <button type="submit" id="btn-save" name="add_Product" class="btn btn-info">Lưu</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    @endsection
