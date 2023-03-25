<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Danhmuc;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MailAdminController extends Controller
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
    //Gửi mã giảm giá cho khách vip
    public function sendCouponVip($coupon)
    {
        $now = Carbon::now('Asia/Ho_Chi_minh')->format('d-m-Y H:i:s');
        $customerCount = Customer::where('customer_vip', 1)->count();
        if ($customerCount > 0) {
            $customerVip = Customer::where('customer_vip', 1)->get();
            $coupon = Coupon::where('coupon_id', $coupon)->first();
            if ($coupon['coupon_date_end'] > strtotime($now)) {
                $start_coupon = date('d-m-Y', $coupon->coupon_date_start);
                $end_coupon = date('d-m-Y', $coupon->coupon_date_end);
                $title_mail = 'Cookie Crumble';
                $data = [];
                foreach ($customerVip as $vip) {
                    $data['email'][] = $vip->customer_email;
                }
                $coupon = [
                    'start_coupon' => $start_coupon,
                    'end_coupon' => $end_coupon,
                    'coupon_times' => $coupon['coupon_times'],
                    'coupon_condition' => $coupon['coupon_condition'],
                    'coupon_number' => $coupon['coupon_number'],
                    'coupon_code' => $coupon['coupon_code'],
                    'coupon_name' => $coupon['coupon_name'],
                ];
                Mail::send('admin.coupon.send_coupon.sendCoupon', ['coupon' => $coupon], function ($message) use ($title_mail, $data) {
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($data['email'], $title_mail);
                });
                Session::put('message', 'Gửi thành công');
                return redirect()->back();
            }
            Session::put('error', 'Mã giảm giá đã hết hạn');
            return redirect()->back();
        }
        Session::put('error', 'Chưa có thành viên Vip');
        return redirect()->back();
    }
    public function mail_example_vip()
    {
        return view('admin.coupon.send_coupon.sendCoupon');
    }
    //Gửi mã giảm giá cho khách bình thường
    public function sendCoupon($coupon)
    {
        $now = Carbon::now('Asia/Ho_Chi_minh')->format('d-m-Y H:i:s');
        $customerCount = Customer::where('customer_vip', 0)->count();
        if ($customerCount > 0) {
            $customer = Customer::where('customer_vip', 0)->get();
            $coupon = Coupon::where('coupon_id', $coupon)->first();
            if ($coupon['coupon_date_end'] > strtotime($now)) {
                $start_coupon = date('d-m-Y', $coupon->coupon_date_start);
                $end_coupon = date('d-m-Y', $coupon->coupon_date_end);
                $title_mail = 'Cookie Crumble';
                $data = [];
                foreach ($customer as $vip) {
                    $data['email'][] = $vip->customer_email;
                }
                $coupon = [
                    'start_coupon' => $start_coupon,
                    'end_coupon' => $end_coupon,
                    'coupon_times' => $coupon['coupon_times'],
                    'coupon_condition' => $coupon['coupon_condition'],
                    'coupon_number' => $coupon['coupon_number'],
                    'coupon_code' => $coupon['coupon_code'],
                    'coupon_name' => $coupon['coupon_name'],
                ];
                Mail::send('admin.coupon.send_coupon.sendCoupon', ['coupon' => $coupon], function ($message) use ($title_mail, $data) {
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($data['email'], $title_mail);
                });
                Session::put('message', 'Gửi thành công');
                return redirect()->back();
            }
            Session::put('error', 'Mã giảm giá đã hết hạn');
            return redirect()->back();
        }
        Session::put('error', 'Chưa có thành viên');
        return redirect()->back();
    }

    public function mail_example()
    {
        return view('admin.coupon.send_coupon.send_coupon');
    }
    //Quen mat khau
    public function forginPassword()
    {
        return view('pages.checkout.forget');
    }
    public function checkEmail(Request $request)
    {
        $data = $request->all();
        $customer = Customer::where('customer_email', '=', $data['email'])->get();
        foreach ($customer as $value) {
            $customer_id = $value->customer_id;
        }
        $now = Carbon::now('Asia/Ho_Chi_minh')->format('d-m-Y');
        $title_mail = 'Lấy lại mật khẩu' . ' ' . $now;
        if ($customer) {
            $count_customer = $customer->count();
            if ($count_customer == 0) {
                return response()->json([
                    'code' => 423
                ]);
            }
            $token_random = Str::random(20);
            $customer = Customer::find($customer_id);
            $customer->customer_token = $token_random;
            $customer->save();
            //send mail
            $to_email = $data['email'];
            $link_reset_pass = url('/update-new-pass?email=' . $to_email . '&token=' . $token_random);
            $data = ['name' => $title_mail, 'body' => $link_reset_pass, 'email' => $data['email']];
            Mail::send('pages.checkout.forget_notify', ['data' => $data], function ($message) use ($title_mail, $data) {
                $message->to($data['email'])->subject($title_mail);
                $message->from($data['email'], $title_mail);
            });
            return response()->json([
                'code' => 200
            ]);
        }
    }
    public function updateNewPass()
    {
        return view('pages.checkout.newpass');
    }
    public function resetNewPass(Request $request)
    {
        $data = $request->all();
        $token_random = Str::random(20);
        $customer = Customer::where('customer_email', '=', $data['email'])
            ->where('customer_token', '=', $data['token'])
            ->get();
        $count = $customer->count();
        if ($count > 0) {
            foreach ($customer as $cus) {
                $customer_id = $cus->customer_id;
            }
            $reset = Customer::find($customer_id);
            $reset->customer_password = md5($data['password_account']);
            $reset->customer_token = $token_random;
            $reset->save();
            return redirect('login-checkout')->with('message', 'Đặt lại mật khẩu thành công.');
        } else {
            return redirect('quen-mat-khau')->with('error', 'Đặt lại mật khẩu thất bại vì link đã quá hạn');
        }
    }
}
