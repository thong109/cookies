@extends('newAdmin')
@section('title', $isInsert ? 'Create Product' : 'Edit Product')

@section('scripts')
    <script>
        const urls = {
            editProduct: '{{ route('EditProduct', '') }}',
            deleteProduct: '{{ route('DeleteProduct') }}',
            createProduct: '{{ route('CreateProduct') }}',
            changeStatus: '{{ route('ChangeStatusOfProduct') }}',
        };
        const mode = '{{ $isInsert ? 'I' : 'U' }}';
    </script>
    {!! Html::script('public/assets/js/admin/product/product-detail.js') !!}
@stop

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper justify-content-between align-items-center">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <div>Sản phẩm
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
                                action="{{ $isInsert ? route('InsertProduct') : route('UpdateProduct', $pro->id) }}"
                                id="form-product" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tên sản phẩm</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ $isInsert ? '' : $pro->name }}" placeholder="Tên sản phẩm">
                                    <input type="hidden" id="id" value="{{ $isInsert ? '' : $pro->id }}">
                                </div>
                                <div class="form-group">
                                    <label for="content">Mô tả</label>
                                    <input type="text" name="content" class="form-control" id="content"
                                        value="{{ $isInsert ? '' : $pro->content }}" placeholder="Mô tả">
                                </div>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <div class="col-md-6 pl-0">
                                            <label for="price">Giá bán</label>
                                            <input type="number" name="price" class="form-control" id="price"
                                                min="0" oninput="this.value = Math.abs(this.value)"
                                                value="{{ $isInsert ? '' : $pro->price }}">
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <label for="cost">Giá gốc</label>
                                            <input type="number" name="cost" class="form-control" id="cost"
                                                min="0" oninput="this.value = Math.abs(this.value)"
                                                value="{{ $isInsert ? '' : $pro->cost }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <div class="col-md-6 pl-0">
                                            <label for="sale">Khuyến mãi</label>
                                            <input type="number" name="sale" class="form-control" id="sale"
                                                min="0" oninput="this.value = Math.abs(this.value)"
                                                value="{{ $isInsert ? '' : $pro->sale }}">
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <label for="quantity">Số lượng</label>
                                            <input type="number" name="quantity" class="form-control" id="quantity"
                                                min="0" oninput="this.value = Math.abs(this.value)"
                                                value="{{ $isInsert ? '' : $pro->quantity }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ckeditor_desc">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="description" id="description"
                                        value="{{ $isInsert ? '' : $pro->description }}">
                                       {{ $isInsert ? '' : $pro->description }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Hình ảnh</label>
                                    <input type="file" name="image" class="form-control" id="image"
                                        accept="image/*">
                                    <img src="{{ $isInsert ? '/camera/public/imgs/default.png' : $pro->image }}"
                                        id="img-tag" width="250px" height="250px" class="pt-3 defaul m-auto d-block" />
                                </div>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <div class="col-md-6 pl-0">
                                            <label for="exampleInputPassword1">Hiển thị</label>
                                            <select name="status" class="form-control input-lg m-bot15">
                                                @foreach ($status as $key => $val)
                                                    <option value="{{ $key }}"
                                                        @if (!$isInsert && $key == $pro->status) selected="selected" @endif>
                                                        {{ $val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <label for="exampleInputPassword1">Thương hiệu</label>
                                            <select name="brand" class="form-control input-lg m-bot15">
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        @if (!$isInsert && $brand->id == $pro->brand_id) selected="selected" @endif>
                                                        {{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tags">Thẻ</label>
                                    <input type="text" name="tags" class="form-control" id="tags"
                                        value="{{ $isInsert ? '' : $pro->tags }}" placeholder="Thẻ">
                                </div>
                                <button type="button" id="btn-save" name="add_Product"
                                    class="btn btn-info">Lưu</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    @endsection
