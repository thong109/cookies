<?php

namespace App\Http\Controllers;

use App\Commons\CodeMasters\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\FreeShip;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

// session_start();

class CheckoutController extends Controller
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

    public function login()
    {
        if (Session::get('customer_id')) {
            return Redirect::to('/home');
        }
        return view('pages.checkout.login');
    }

    public function register()
    {
        if (Session::get('customer_id')) {
            return Redirect::to('/home');
        }
        return view('pages.checkout.register');
    }

    public function createAccount(Request $request)
    {
        if (Customer::where('customer_email', '=', $request->customer_email)->exists()) {
            return response()->json([
                'code' => 400
            ]);
        }
        $newCustomer = new Customer();
        $newCustomer['customer_name'] = $request->customer_name;
        $newCustomer['customer_email'] = $request->customer_email;
        $newCustomer['customer_password'] = md5($request->customer_password);
        $newCustomer['customer_phone'] = $request->customer_phone;
        $newCustomer['customer_address'] = $request->customer_address;
        $newCustomer->save();
        Session::put('customer_id', $newCustomer->customer_id);
        Session::put('customer', $newCustomer);
        Session::put('customer_name', $request->customer_name);

        return response()->json([
            'code' => 200
        ]);
    }

    public function checkout(Request $request)
    {
        if (Session::get('customer_id') && Session::get('cart')) {
            $customer = Session::get('customer');
            $carts = Session::get('cart');
            $city = City::orderBy('matp', 'asc')->get();
            return view('pages.checkout.checkout', compact('city', 'carts', 'customer'));
        }
        return Redirect::to('account/login');
    }

    public function pay()
    {
        $customer = Session::get('customer');
        $carts = Session::get('cart');
        $city = City::orderBy('matp', 'asc')->get();
        return view('pages.checkout.payment', compact('city', 'carts', 'customer'));
    }

    public function save_checkout(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_note'] = $request->shipping_note;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id', $shipping_id);
        return Redirect::to('/payment');
    }
    public function payment()
    {
        $cate_product = DB::table('tbl_category')->where('category_status', '0')->orderBy('category_id', 'desc')->get();

        return view('pages.checkout.payment')->with('category', $cate_product);
    }
    public function logout()
    {
        Session::flush();
        return Redirect::to('/account/login');
    }

    public function loginCustomer(Request $request)
    {
        $email = $request->customer_email;
        $password = md5($request->customer_password);
        $result = Customer::where('customer_email', $email)->where('customer_password', $password)->first();
        if (isset($result)) {
            Session::put('customer_id', $result->customer_id);
            Session::put('customer', $result);
            Session::put('customer_name', $request->customer_name);
            return response()->json([
                'code' => 200
            ]);
        }
        return response()->json([
            'code' => 400
        ]);
    }

    public function order_place(Request $request)
    {
        //insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lí';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);
        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lí';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        //isert order_details
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if ($data['payment_method'] == 1) {
            echo 'Thanh toán online';
        } elseif ($data['payment_method'] == 2) {
            Cart::destroy();
            $cate_product = DB::table('tbl_category')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
            return view('pages.checkout.handcast')->with('category', $cate_product);
        }
        return Redirect::to('/payment');
    }
    //Order admin

    public function view_order($orderId)
    {
        $this->check();
        $order_by_id = DB::table('tbl_order')
            ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')
            ->select('tbl_order.*', 'tbl_customer.*', 'tbl_shipping.*', 'tbl_order_details.*')->where('tbl_order.order_id', $orderId)->first();

        $manager_order_by_id = view('admin.manager.view_order')->with('order_by_id', $order_by_id);
        return view('admin_layout')->with('admin.manager.view_order', $manager_order_by_id);
    }

    // public function select_delivery_home(Request $request)
    // {
    //     $data = $request->all();
    //     if ($data['action']) {
    //         $output = '';
    //         if ($data['action'] == "city") {
    //             $select_province = Province::where('matp', $data['ma_id'])->orderBy('maqh', 'asc')->get();
    //             $output .= '<option value="">---Chọn quận huyện---</option>';
    //             foreach ($select_province as $key => $province) {
    //                 $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
    //             }
    //         } else {
    //             $select_wards = Wards::where('maqh', $data['ma_id'])->orderBy('xaid', 'asc')->get();
    //             $output .= '<option value="">---Chọn xã phường---</option>';
    //             foreach ($select_wards as $key => $ward) {
    //                 $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xaphuong . '</option>';
    //             }
    //         }
    //     }
    //     echo $output;
    // }

    public function caculateFee(Request $request)
    {
        $data = $request->all();
        if ($data['city']) {
            $feeship = FreeShip::where('fee_matp', $data['city'])->where('fee_maqh', $data['province'])->where('fee_xaid', $data['wards'])->get();
            if ($feeship) {
                $count_feeship = $feeship->count();
                if ($count_feeship > 0) {
                    foreach ($feeship as $key => $fee) {
                        Session::put('fee', (int)($fee->fee_feeship));
                        Session::save();
                    }
                } else {
                    Session::put('fee', 20000);
                    Session::save();
                }
            }
        }
    }

    public function del_fee()
    {
        Session::forget('fee');
        return redirect()->back();
    }
    public function confirm_order(Request $request)
    {
        $data = $request->all();
        if (Session::get('cart') == true) {
            $arr = [];
            foreach (Session::get('cart') as $key => $cart) {
                $id = $cart['product_id'];
                foreach (Session::get('cart') as $cart) {
                    $price = $cart['product_qty'] * $cart['product_price'];
                    array_push($arr, $price);
                }
                $total = array_sum($arr);
                // $coupon = $data['order_coupon'];
                // $fee = $data['order_fee'];
            }
            $checkProduct = Product::where('id', $id)->where('status', Status::SHOW())->first();
            if (!$checkProduct) {
                // Session::forget('coupon');
                // Session::forget('fee');
                // Session::forget('cart');
                return response()->json([
                    'data' => 'Kotontai'
                ]);
                // dd('ko ton tai');
            } elseif ($cart['product_qty'] > $checkProduct->quantity) {
                // Session::forget('coupon');
                // Session::forget('fee');
                // Session::forget('cart');
                return response()->json([
                    'data' => false
                ]); //Đúng
            } elseif ($cart['product_qty'] > 0) {
                // get coupon
                if ($data['order_coupon'] != 'no') {
                    $coupon = Coupon::where('coupon_code', $data['order_coupon'])->first();
                    $coupon->coupon_used = $coupon->coupon_used . ',' . Session::get('customer_id');
                    $coupon->coupon_times = $coupon->coupon_times - 1;
                    $coupon_mail = $coupon->coupon_code;
                    $coupon_condition = $coupon->coupon_condition;
                    $coupon_number = $coupon->coupon_number;
                    $coupon->save();
                } else {
                    $coupon_mail = 'Không có';
                }
                //get vận chuyển
                $shipping = new Shipping();
                $shipping->shipping_name = $data['shipping_name'];
                $shipping->shipping_address = $data['shipping_address'];
                $shipping->shipping_phone = $data['shipping_phone'];
                $shipping->shipping_email = $data['shipping_email'];
                $shipping->shipping_notes = $data['shipping_notes'];
                $shipping->shipping_method = $data['shipping_method'];
                $shipping->save();
                $shipping_id = $shipping->shipping_id;
                $checkout_code = substr(md5(microtime()), rand(0, 25), 9);
                //get order
                $order = new Order();
                $order->customer_id = Session::get('customer_id');
                $order->shipping_id = $shipping_id;
                $order->order_status = 1;
                $order->order_code  = $checkout_code;
                $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
                $date_order = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
                $order->created_at = $today;
                $order->order_date = $date_order;
                $order->save();
                if (Session::get('cart') == true) {
                    foreach (Session::get('cart') as $key => $cart) {
                        $order_details = new OrderDetail();
                        $order_details->order_code = $checkout_code;
                        $order_details->product_id = $cart['product_id'];
                        $order_details->product_name = $cart['product_name'];
                        $order_details->product_price = $cart['product_price'];
                        $order_details->product_sales_quantity = $cart['product_qty'];
                        $order_details->product_coupon = $data['order_coupon'];
                        $order_details->product_feeship = $data['order_fee'];
                        $order_details->can_comment = true;
                        $order_details->save();
                    }
                }
                $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
                $title_mail = "Đơn hàng xác nhận" . ' ' . $now;
                $customer = Customer::find(Session::get('customer_id'));
                $data['email'][] = $customer->customer_email;
                if (Session::get('cart') == true) {
                    foreach (Session::get('cart') as $key => $cart_mail) {
                        $cart_array[] = array(
                            'product_name' => $cart_mail['product_name'],
                            'product_price' => $cart_mail['product_price'],
                            'product_qty' => $cart_mail['product_qty'],
                        );
                    }
                }
                if (Session::get('fee') == true) {
                    $fee = Session::get('fee');
                } else {
                    $fee = 20000;
                }
                $shipping_array = array(
                    'fee' => $fee,
                    'customer_name' => $customer->name,
                    'shipping_name' => $data['shipping_name'],
                    'shipping_email' => $data['shipping_email'],
                    'shipping_phone' => $data['shipping_phone'],
                    'shipping_address' => $data['shipping_address'],
                    'shipping_notes' => $data['shipping_notes'],
                    'shipping_method' => $data['shipping_method'],
                );
                $ordercode_mail = array(
                    'coupon_code' => $coupon_mail,
                    'order_code' => $checkout_code,
                    'total' => $total
                    // 'coupon_number'=> $coupon_number,
                    // 'coupon_condition'=> $coupon_condition,
                );
                Mail::send('pages.mail.mail_order', ['cart_array' => $cart_array, 'shipping_array' => $shipping_array, 'code' => $ordercode_mail], function ($message) use ($title_mail, $data) {
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($data['email'], $title_mail);
                });
                Session::forget('coupon');
                Session::forget('fee');
                Session::forget('cart');
                return response()->json([
                    'data' => true
                ]);
            }
        }
    }
    public function mailOrder()
    {
        return view('pages.mail.mail_order');
    }

    public function fetchTotal()
    {
        $carts = Session::get('cart');
        $total = 0;
        $couponPrice = 0;
        $fee = 0;
        if (isset($carts)) {
            foreach ($carts as $cart) {
                $subtotal = $cart['product_price'] * $cart['product_qty'];
                $total += $subtotal;
            }
        }
        if (Session::get('coupon')) {
            $coupon = Session::get('coupon');
            if ($coupon[0]['coupon_condition'] == 1) {
                $couponPrice = ($total * $coupon[0]['coupon_number'] / 100);
            }
            if ($coupon[0]['coupon_condition'] == 2) {
                $couponPrice = $coupon[0]['coupon_number'];
            }
        }
        if (Session::get('fee')) {
            $fee = Session::get('fee');
        }
        return response()->json([
            'fee' => $fee,
            'coupon' => $couponPrice,
            'total' => $total,
        ]);
    }
}
