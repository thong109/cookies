@extends('newAdmin')
@section('title', $isInsert ? 'Create Category' : 'Edit Category')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper justify-content-between align-items-center">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <div>Danh mục
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
                                action="{{ $isInsert ? route('InsertCategory') : route('UpdateCategory', $category->id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tên danh mục</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ $isInsert ? '' : $category->name }}" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="title">Mô tả</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                        value="{{ $isInsert ? '' : $category->title }}" placeholder="Mô tả">
                                </div>
                                <div class="form-group">
                                    <label for="ckeditor_desc">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="description"
                                        value="{{ $isInsert ? '' : $category->description }}">
                                       {{ $isInsert ? '' : $category->description }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Hình ảnh</label>
                                    <input type="file" name="image" class="form-control" id="image"
                                        accept="image/*">
                                    <img src="{{ $isInsert ? '/camera/public/imgs/default.png' : $category->image }}"
                                        id="img-tag" width="250px" height="250px" class="pt-3 defaul m-auto d-block" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="status" class="form-control input-lg m-bot15">
                                        @foreach ($status as $key => $val)
                                            <option value="{{ $key }}"
                                                @if (!$isInsert && $key == $category->status) selected="selected" @endif>
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
