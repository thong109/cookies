<?php

namespace App\Http\Controllers;

use App\Commons\CodeMasters\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Symfony\Component\VarDumper\Cloner\Data;
use App\Models\Coupon;
use Illuminate\Support\Carbon;

// session_start();

class CartController extends Controller
{
    // public function save_cart(Request $request)
    // {
    //     $product_id = $request->productid_hidden;
    //     $quantity = $request->qty;
    //     $product_info = DB::table('tbl_product')->where('product_id', $product_id)->first();
    //     $data['id'] = $product_info->product_id;
    //     $data['qty'] = $quantity;
    //     $data['name'] = $product_info->product_name;
    //     $data['price'] = $product_info->product_price;
    //     $data['weight'] = $product_info->product_price;
    //     $data['options']['image'] = $product_info->product_image;
    //     Cart::add($data);
    //     return Redirect::to('show-cart');
    //     // Cart::destroy();
    // }
    // public function show_cart(Request $request)
    // {
    //     return view('cart.show_cart');
    // }
    // public function delete_to_cart($rowId){
    //     Cart::update($rowId,0);
    //     return Redirect::to('show-cart');
    // }
    // public function update_cart_quantity(Request $request)
    // {
    //     $rowId = $request->rowId_cart;
    //     $qty = $request->cart_quantity;
    //     Cart::update($rowId, $qty);
    //     return Redirect::to('show-cart');
    // }

    public function fetchCart()
    {
        $coupon = '';
        if (Session::get('coupon')) {
            $coupon = Session::get('coupon');
        }
        if (Session::get('cart')) {
            $cart = Session::get('cart');
            return response()->json([
                'data' => $cart,
                'coupon' => $coupon
            ]);
        }
        return response()->json([
            'data' => '',
            'coupon' => $coupon
        ]);
    }

    public function addToCart(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_avaiable = 0;
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_avaiable++;
                    $cart[$key]['product_qty'] += 1;
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                    'product_brand' => $data['cart_product_brand'],
                    'product_slug' => $data['cart_product_slug'],
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                'product_brand' => $data['cart_product_brand'],
                'product_slug' => $data['cart_product_slug'],
            );
        }
        Session::put('cart', $cart);
        Session::save();
        return response()->json([
            'code' => 200
        ]);
    }

    public function cart(Request $request)
    {
        return view('cart.cart');
    }

    public function deleteCart(Request $request)
    {
        $data = $request->all();
        $sessionId = $data['sessionId'];
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $sessionId) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return response()->json([
                'code' => 200
            ]);
        }
    }
    public function updateCart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if ($cart == true) {
            $qtys = json_decode($data['qty'], true);
            // $message = '';
            foreach ($qtys as $qty) {
                foreach ($qty as $in => $k) {
                    foreach ($cart as $session => $val) {
                        if ($val['session_id'] == $in && $k <= $cart[$session]['product_quantity']) {
                            $cart[$session]['product_qty'] = $k;
                            // $message .= 'Cập nhật số lượng : ' . $cart[$session]['product_name'] . ' thành công';
                            Session::put('cart', $cart);
                        }
                        // elseif ($val['session_id'] == $key && $qty > $cart[$session]['product_quantity']) {
                        //     $message .= 'Cập nhật số lượng : ' . $cart[$session]['product_name'] . ' thất bại';
                        // }
                    }
                }
            }
            return response()->json([
                'code' => 200
            ]);
            // return redirect()->back()->with('message', $message);
        }
        // else {
        //     return redirect()->back()->with('message', 'Cập nhật giỏ hàng thất bại');
        // }
    }
    public function delete_all_cart()
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message', 'Đã xóa hết giỏ hàng');
        }
    }
    public function checkCoupon(Request $request)
    {
        $data = $request->all();
        $now = strtotime(Carbon::now('Asia/Ho_Chi_Minh'));
        $coupon = Coupon::where('coupon_code', $data['coupon'])
            ->where('coupon_status', Status::SHOW())->where('coupon_date_end', '>=', $now)
            ->where('coupon_used', 'LIKE', '%' . Session::get('customer_id') . '%')
            ->first();
        if (Session::get('customer_id')) {
            if (isset($coupon)) {
                return response()->json([
                    'code' => 'E048'
                ]);
            }
            $coupon = Coupon::where('coupon_code', $data['coupon'])
                ->where('coupon_status', Status::SHOW())
                ->where('coupon_date_end', '>=', $now)
                ->first();
            if (isset($coupon)) {
                if ($coupon->coupon_times > 0) {
                    if ($coupon->count() > 0) {
                        $couponSession = Session::get('coupon');
                        if (isset($couponSession)) {
                            $cou[] = array(
                                'coupon_code' => $coupon->coupon_code,
                                'coupon_condition' => $coupon->coupon_condition,
                                'coupon_number' => $coupon->coupon_number,
                            );
                            Session::put('coupon', $cou);
                            Session::save();
                            return response()->json([
                                'coupon' => $coupon,
                                'code' => 'S015'
                            ]);
                        }
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        Session::put('coupon', $cou);
                        Session::save();
                        return response()->json([
                            'code' => 'S015'
                        ]);
                    }
                }
                Session::forget('coupon');
                return response()->json([
                    'code' => 'E047'
                ]);
            }
            Session::forget('coupon');
            return response()->json([
                'code' => 'E044'
            ]);
        }
        return response()->json([
            'code' => 'E402'
        ]);
    }

    public function delCoupon()
    {
        Session::forget('coupon');
        return response()->json([
            'code' => 200
        ]);
    }
}
