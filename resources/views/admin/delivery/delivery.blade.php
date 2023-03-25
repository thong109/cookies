@extends('newAdmin')
@section('title', 'Delivery')
@section('scripts')
    <script>
        const urls = {
            fetchDelivery: '{{ route('FetchDelivery') }}',
            fetchFeeship: '{{ route('FetchFeeship') }}',
            updateDelivery: '{{ route('UpdateDelivery') }}',
            insertDelivery: '{{ route('InsertDelivery') }}',
        };
    </script>
    {!! Html::script('public/assets/js/admin/delivery/delivery-list.js') !!}
@stop

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper justify-content-between align-items-center">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <div>Vận chuyển
                        <div class="page-title-subheading">Quản lý vận chuyển</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-body">
                <div class="position-center">
                    <form role="form">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn thành phố</label>
                            <select name="city" id="city" class="form-control input-lg m-bot15 city choose ">
                                <option value="">---Chọn thành phố---</option>
                                @foreach ($city as $key => $c_t)
                                    <option value="{{ $c_t->matp }}">{{ $c_t->name_city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn quận huyện</label>
                            <select name="province" id="province" class="form-control input-lg m-bot15 province choose ">
                                <option value="">---Chọn quận huyện---</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn xã phường</label>
                            <select name="wards" id="wards" class="form-control input-lg m-bot15 wards">
                                <option value="">---Chọn xã phường---</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phí vận chuyển</label>
                            <input type="text" name="fee_ship" class="form-control fee_ship" id="fee_ship">
                        </div>
                        <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển
                        </button>
                    </form>
                </div>
                <br>
                <div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên thành phố</th>
                                    <th>Tên quận huyện</th>
                                    <th>Tên xã phường</th>
                                    <th>Phí ship (VND)</th>
                                </tr>
                            </thead>
                            <tbody id="load_delivery">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
