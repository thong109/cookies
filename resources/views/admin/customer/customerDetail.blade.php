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
                    <div>Khách hàng
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
                            <form role="form" action="{{ route('InsertCustomer') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="customer_name">Tên khách hàng</label>
                                    <input type="text" name="customer_name" class="form-control" id="customer_name"
                                        placeholder="Tên khách hàng">
                                </div>
                                <div class="form-group">
                                    <label for="customer_email">Email</label>
                                    <input type="text" name="customer_email" class="form-control" id="customer_email"
                                        placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="customer_password">Mật khẩu</label>
                                    <input type="password" name="customer_password" class="form-control"
                                        id="customer_password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="customer_phone">Điện thoại</label>
                                    <input type="text" name="customer_phone" class="form-control" id="customer_phone"
                                        placeholder="077922..">
                                </div>
                                <div class="form-group">
                                    <label for="customer_address">Địa chỉ</label>
                                    <input type="text" name="customer_address" class="form-control" id="customer_address"
                                        placeholder="Đà Nẵng...">
                                </div>
                                <div class="form-group">
                                    <label for="name">Hình ảnh</label>
                                    <input type="file" name="image" class="form-control" id="image"
                                        accept="image/*">
                                    <img src="{{ $isInsert ? '/camera/public/imgs/default.png' : $category->image }}"
                                        id="img-tag" width="250px" height="250px" class="pt-3 defaul m-auto d-block" />
                                </div>
                                <button type="submit" name="add_category" class="btn btn-info">Lưu</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    @endsection
