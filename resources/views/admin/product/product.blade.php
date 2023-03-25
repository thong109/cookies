{{-- @extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-left">
                    {{ __('Listproduct') }}
                    <a class="btn btn-xs btn-primary" href="{{ URL::to('add-product') }}">{{ __('Addproduct') }}</a>
                </div>
            </div>
        </div>
        <?php
        $message = Session::get('message');
        if ($message) {
            echo '<span class="text-alert">' . $message . '</span>';
            Session::put('message', null);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên tin tức</th>
                        <th>Thương hiệu</th>
                        <th>Hình ảnh</th>
                        <th>Thư viện ảnh</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Giá gốc</th>
                        <th>Mô tả</th>
                        <th>Nội dung</th>
                        <th>Hiển thị</th>
                        <th>Tình trạng</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $pro)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{ $pro->product_name }}</td>
                            <td>{{ $pro->Product_name }}</td>
                            <td><img src="{{ asset('public/uploads/product/' . $pro->product_image) }}" alt=""
                                    width="150px" height="150px"></td>
                            <td><a href="{{ 'add-gallery/' . $pro->product_id }}">Thêm thư viện ảnh</a></td>
                            <td>{{ number_format($pro->product_quantity) }}</td>
                            <td>
                                @php
                                    $pro->product_price = $pro->product_price - ($pro->product_price * $pro->product_sale) / 100;
                                @endphp
                                {{ number_format($pro->product_price) }}
                                VNĐ</td>
                            <td>{{ number_format($pro->product_cost) }} VNĐ</td>
                            <td class="rutgon">{!! $pro->product_desc !!}</td>
                            <td>{{ $pro->product_content }}</td>
                            <td><span class="text-ellipsis">
                                    <?php
                    if($pro->product_status==0){
                ?>
                                    <a href="{{ URL::to('/unactive-product/' . $pro->product_id) }}"><span>Hiện</span></a>
                                    <?php
                    }else{
                    ?>
                                    <a href="{{ URL::to('/active-product/' . $pro->product_id) }}"><span>Ẩn</span></a>
                                    <?php
                    }
                 ?>
                                </span></td>

                            <td><span class="text-ellipsis">
                                    <?php
                                    if ($pro->product_quantity == 0) {
                                        echo '<span>Hết hàng</span>';
                                    } else {
                                        echo '<span>Còn hàng</span>';
                                    }
                                    ?>
                                </span></td>
                            <td>
                                <a href="{{ URL::to('/edit-product/' . $pro->product_id) }}" class="active"
                                    ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                <a onclick="return confirm('Bạn có muốn xóa?')"
                                    href="{{ URL::to('/delete-product/' . $pro->product_id) }}" class="active"
                                    ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <form action="{{ url('import-product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" accept=".xlsx"><br>
                <input type="submit" value="Import product" name="import_product" class="btn btn-warning">
            </form>
            <form action="{{ url('export-product') }}" method="POST">
                @csrf
                <input type="submit" value="Export product" name="export_product" class="btn btn-success">
            </form>
        </div>

    </div>
    </div>
@endsection --}}

@extends('newAdmin')
@section('title', __('Product'))
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper justify-content-between align-items-center">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <div>Sản phẩm
                        <div class="page-title-subheading">Quản lý sản phẩm</div>
                    </div>
                </div>
                <div class="page-title-icon">
                    <a href="{{ route('CreateProduct') }}"><i class="fa fa-plus"></i></a>
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
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Giá gốc</th>
                            <th>Khuyến mãi</th>
                            <th>Hiển thị</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($products) > 0)
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <img width="42" height="42" class="rounded-circle"
                                                        src="{{ $product->image }}" alt="">
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">{{ $product->name }}</div>
                                                    <div class="widget-subheading">{{ $product->content }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ number_format($product->price) }} VNĐ</td>
                                    <td>{{ number_format($product->cost) }} VNĐ</td>
                                    <td>{{ $product->sale > 0 ? $product->sale . ' %' : 'Không có' }}</td>
                                    <td>
                                        <span class="text-ellipsis">
                                            <a href="{{ route('ChangeStatusOfProduct', ['id' => $product->id]) }}">
                                                <span
                                                    class="fa-solid fa-eye{{ $product->status == 0 ? '-slash' : '' }}"></span>
                                            </a>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('EditProduct', ['id' => $product->id]) }}" class="active"
                                            ui-toggle-class=""><i
                                                class="fa-solid fa-pencil text-success text-active"></i></a>
                                        <a onclick="return confirm('Bạn có muốn xóa?')"
                                            href="{{ route('DeleteProduct', ['id' => $product->id]) }}" class="active"
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
