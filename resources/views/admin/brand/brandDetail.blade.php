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
                    <div>Thương hiệu
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
                                action="{{ $isInsert ? route('InsertBrand') : route('UpdateBrand', $brand->id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tên thương hiệu</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ $isInsert ? '' : $brand->name }}" placeholder="Tên thương hiệu">
                                </div>
                                <div class="form-group">
                                    <label for="ckeditor_desc">Mô tả thương hiệu</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="description"
                                        value="{{ $isInsert ? '' : $brand->description }}" id="ckeditor_desc">
                                       {{ $isInsert ? '' : $brand->description }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <div class="col-md-6 pl-0">
                                            <label for="exampleInputPassword1">Hiển thị</label>
                                            <select name="status" class="form-control input-lg m-bot15">
                                                @foreach ($status as $key => $val)
                                                    <option value="{{ $key }}"
                                                        @if (!$isInsert && $key == $brand->status) selected="selected" @endif>
                                                        {{ $val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <label for="exampleInputPassword1">Danh mục</label>
                                            <select name="category" class="form-control input-lg m-bot15">
                                                @foreach ($categories as $val)
                                                    <option value="{{ $val->id }}"
                                                        @if (!$isInsert && $val->id == $brand->status) selected="selected" @endif>
                                                        {{ $val->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Lưu</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    @endsection
