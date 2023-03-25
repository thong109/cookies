@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm Người dùng
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('save-staff')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" name="admin_email" class="form-control" id="exampleInputEmail1" placeholder="Email...">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mật Khẩu</label>
                                    <input type="password" name="admin_password" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Họ tên</label>
                                    <input class="form-control" id="exampleInputPassword1" placeholder="Họ tên" name="admin_name">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Điện thoại</label>
                                    <input type="number" class="form-control" id="exampleInputPassword1" name="admin_phone">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="admin_address" placeholder="Địa chỉ ....">
                                </div>
                                <button type="submit" name="add_staff" class="btn btn-info">Lưu</button>
                            </form>
                            </div>
                        </div>
                    </section>

            </div>
@endsection
