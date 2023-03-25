@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-left">
                Người dùng
                <a class="btn btn-xs btn-primary" href="{{ URL::to('add-staff') }}">Thêm Người dùng</a>
            </div>
        </div>
    </div>
      <?php
        $message = Session::get('message');
        if ($message) {
            echo '<span class="text-alert">'.$message.'</span>';
            Session::put('message',null);
        }
    ?>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light" id="myTable">
          <thead>
            <tr>
              <th>Tên</th>
              <th>Email</th>
              <th>Điện thoại</th>
              <th>Địa chỉ</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
              @foreach($getStaff as $pro)
            <tr>
              <td>{{$pro ->admin_name}}</td>
              <td>{{$pro->admin_email}}</td>
              <td>{{$pro->admin_phone}}</td>
              <td>{{$pro->admin_address}}</td>
              <td>
                <a onclick="return confirm('Bạn có muốn xóa?')" href="{{URL::to('/delete-staff/'.$pro->admin_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </div>
@endsection
