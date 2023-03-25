<?php

namespace App\Http\Controllers;

use App\Commons\CodeMasters\AccountType;
use App\Commons\CodeMasters\CouponType;
use App\Commons\CodeMasters\Status;
use App\Models\Coupon;
use App\Models\VoucherSend;
use App\Models\VoucherWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

session_start();

class CouponController extends Controller
{
    public function check()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function coupon(Request $request)
    {
        $this->check();
        $request->session()->forget('oldCoupon');
        $today = Carbon::now('Asia/Ho_Chi_Minh');
        $now = strtotime($today);
        $coupons = Coupon::leftJoin('voucher_sends', 'voucher_sends.coupon_id', '=', 'tbl_coupon.coupon_id')
            ->OrderBy('tbl_coupon.coupon_id', 'desc')
            ->get();
        return view('admin.coupon.coupon')->with(compact('coupons', 'now'));
    }

    public function createCoupon()
    {
        $this->check();
        $status = Status::toArray();
        $couponType = CouponType::toArray();
        $accountType = AccountType::toArray();
        return view('admin.coupon.couponDetail', compact('status', 'couponType', 'accountType'));
    }
    public function insertCoupon(Request $request)
    {
        $this->check();
        $data = $request->all();
        $request->session()->put('oldCoupon', $request->all());
        $coupons = new Coupon();
        if ($coupons->where('coupon_name', $data['coupon_name'])->exists()) {
            Session::put('message', 'Tên mã giảm giá đã tồn tại');
            return Redirect::to('coupon/create');
        }
        if ($coupons->where('coupon_code', $data['coupon_code'])->exists()) {
            Session::put('message', 'Mã giảm giá đã tồn tại');
            return Redirect::to('coupon/create');
        }
        $coupon = new Coupon();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_times = $data['coupon_times'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_date_start = strtotime($data['coupon_date_start']);
        $coupon->coupon_date_end = strtotime($data['coupon_date_end']);
        $coupon->coupon_status = $data['status'];
        $coupon->save();

        $couponSend = new VoucherSend();
        $couponSend->coupon_id = $coupon->coupon_id;
        if (isset($data['vip'])) {
            $couponSend->customer_vip = filter_var($data['vip'], FILTER_VALIDATE_BOOLEAN);
        } else {
            $couponSend->customer_vip = false;
        }
        if (isset($data['normal'])) {
            $couponSend->customer_normal = filter_var($data['normal'], FILTER_VALIDATE_BOOLEAN);
        } else {
            $couponSend->customer_normal = true;
        }
        $couponSend->save();

        Session::put('message', 'Thêm mã giảm giá thành công');
        return Redirect::to('coupon');
    }

    public function deleteCoupon(Request $request)
    {
        $this->check();
        $id = $request['id'];
        Coupon::where('coupon_id', $id)->delete();
        VoucherSend::where('coupon_id', $id)->delete();
        VoucherWallet::where('coupon_id', $id)->delete();
        Session::put('message', 'Xóa mã giảm giá thành công');
        return Redirect::to('coupon');
    }

    public function changeStatus(Request $request)
    {
        $this->check();
        $id = $request['id'];
        $category = Coupon::where('coupon_id', $id)->first();
        if ($category['coupon_status'] == 0) {
            $category->coupon_status = 1;
            $category->save();
            return Redirect::to('coupon');
        }
        $category->coupon_status = 0;
        $category->save();
        return Redirect::to('coupon');
    }
}
