<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class VnpayController extends Controller
{
    public function vnPay(Request $request)
    {
        $data = $request->all();
        $fee = Session::get('fee');
        $couponS = Session::get('coupon');
        $arr = [];
        foreach (Session::get('cart') as $cart) {
            $price = $cart['product_qty'] * $cart['product_price'];
            array_push($arr, $price);
        }
        $total = array_sum($arr);
        if (isset($couponS)) {
            if ($couponS[0]['coupon_condition'] === 1) {
                $total = $total - ($total * $couponS[0]['coupon_number'] / 100);
            }
            if ($couponS[0]['coupon_condition'] === 2) {
                $total = $total = $couponS[0]['coupon_number'];
            }
        }
        $checkout_code = substr(md5(microtime()), rand(0, 25), 9);
        $totalPrice = $total + $fee;
        return view('vnpay.index', compact('totalPrice', 'checkout_code'));
    }

    public function vnpayment(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $startTime = date("YmdHis");
        // $expire = date('YmdHis', strtotime('+1 minutes', strtotime($startTime)));
        $vnp_TxnRef = $request->order_id;
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount = $request->amount * 100;
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $VNP_TMNCODE = 'DLMCVFEJ';
        $VNP_URL = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';
        $VNP_HASH_SECRET = 'YGKYJUVYKLZJYNHQLHZGUONBRZLUWLTU';
        // $vnp_ExpireDate = $expire;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $VNP_TMNCODE,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => route('vnpay.return'),
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate" => $vnp_ExpireDate,
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urldecode($key) . "=" . urldecode($value) . '&';
        }

        $vnp_Url = $VNP_URL . "?" . $query;
        if ($VNP_HASH_SECRET) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $VNP_HASH_SECRET); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        $customer = Session::get('customer');
        if ($request->vnp_ResponseCode == "00") {
            $vnpay = new Payment();
            $vnpay->vnp_TxnRef = $request->vnp_TxnRef;
            $vnpay->vnp_Amount = $request->vnp_Amount;
            $vnpay->vnp_TransactionStatus = $request->vnp_TransactionStatus;
            $vnpay->vnp_CardType = $request->vnp_CardType;
            $vnpay->vnp_BankCode = $request->vnp_BankCode;
            $vnpay->vnp_PayDate = $request->vnp_PayDate;
            $vnpay->vnp_OrderInfo = $request->vnp_OrderInfo;
            $vnpay->customer_id = Session::get('customer_id');
            $vnpay->save();

            // Mail
            $fee = Session::get('fee');
            $couponS = Session::get('coupon');
            $arr = [];
            foreach (Session::get('cart') as $cart) {
                $price = $cart['product_qty'] * $cart['product_price'];
                array_push($arr, $price);
            }
            $total = array_sum($arr);
            $couponCode = 'no';
            if (isset($couponS)) {
                if ($couponS[0]['coupon_condition'] === 1) {
                    $coupon = Coupon::where('coupon_code', $couponS[0]['coupon_code'])->first();
                    $coupon->coupon_used = $coupon->coupon_used . ',' . Session::get('customer_id');
                    $coupon->coupon_times = $coupon->coupon_times - 1;
                    $couponCode = $coupon->coupon_code;
                    $coupon->save();
                    $total = $total - ($total * $couponS[0]['coupon_number'] / 100);
                }
                if ($couponS[0]['coupon_condition'] === 2) {
                    $coupon = Coupon::where('coupon_code', $couponS[0]['coupon_code'])->first();
                    $coupon->coupon_used = $coupon->coupon_used . ',' . Session::get('customer_id');
                    $coupon->coupon_times = $coupon->coupon_times - 1;
                    $couponCode = $coupon->coupon_code;
                    $coupon->save();
                    $total = $total = $couponS[0]['coupon_number'];
                }
            }
            //get vận chuyển
            $shipping = new Shipping();
            $shipping->shipping_name = $customer['customer_name'];
            $shipping->shipping_address = $customer['customer_address'];
            $shipping->shipping_phone = $customer['customer_phone'];
            $shipping->shipping_email = $customer['customer_email'];
            $shipping->shipping_method = 0;
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
                    $order_details->product_coupon = $couponCode;
                    $order_details->product_feeship = $fee;
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
            $shipping_array = array(
                'fee' => $fee,
                'customer_name' => $customer->name,
                'shipping_name' => $customer['customer_name'],
                'shipping_email' => $customer['customer_email'],
                'shipping_phone' => $customer['customer_phone'],
                'shipping_address' => $customer['customer_address'],
                'shipping_method' => 0,
            );
            $ordercode_mail = array(
                'coupon_code' => $couponCode,
                'order_code' => $checkout_code,
                'total' => $total
            );
            Mail::send('pages.mail.mail_order', ['cart_array' => $cart_array, 'shipping_array' => $shipping_array, 'code' => $ordercode_mail], function ($message) use ($title_mail, $data) {
                $message->to($data['email'])->subject($title_mail);
                $message->from($data['email'], $title_mail);
            });
            Session::forget('cart');
            Session::forget('coupon');
            Session::forget('fee');
            return redirect('/home')->with('message', 'Bạn đã thanh toán thành công');
        }
        Session::forget('cart');
        Session::forget('coupon');
        Session::forget('fee');
        return redirect('/home')->with('message', 'Thanh toán thất bại');
    }

    public function online()
    {
        return view('admin.online.index');
    }

    public function checkFee()
    {
        if (Session::get('fee')) {
            return response()->json([
                'code' => 200
            ]);
        }
        return response()->json([
            'code' => 'E057'
        ]);
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momo(Request $request)
    {
        $data = $request->all();
        $fee = Session::get('fee');
        $couponS = Session::get('coupon');
        $arr = [];
        foreach (Session::get('cart') as $cart) {
            $price = $cart['product_qty'] * $cart['product_price'];
            array_push($arr, $price);
        }
        $total = array_sum($arr);
        if (isset($couponS)) {
            if ($couponS[0]['coupon_condition'] === 1) {
                $total = $total - ($total * $couponS[0]['coupon_number'] / 100);
            }
            if ($couponS[0]['coupon_condition'] === 2) {
                $total = $total - $couponS[0]['coupon_number'];
            }
        }

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $total + $fee;
        $orderId = time() . "";
        $redirectUrl = route('momo.return');
        $ipnUrl = route('momo.return');
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);
        return redirect()->to($jsonResult['payUrl']);
    }

    public function momoReturn(Request $request)
    {
        $data = $request->all();
        $customer = Session::get('customer');
        if ($data['resultCode'] == 0) {
            $fee = Session::get('fee');
            $couponS = Session::get('coupon');
            $arr = [];
            foreach (Session::get('cart') as $cart) {
                $price = $cart['product_qty'] * $cart['product_price'];
                array_push($arr, $price);
            }
            $total = array_sum($arr);
            $couponCode = 'no';
            if (isset($couponS)) {
                if ($couponS[0]['coupon_condition'] === 1) {
                    $coupon = Coupon::where('coupon_code', $couponS[0]['coupon_code'])->first();
                    $coupon->coupon_used = $coupon->coupon_used . ',' . Session::get('customer_id');
                    $coupon->coupon_times = $coupon->coupon_times - 1;
                    $couponCode = $coupon->coupon_code;
                    $coupon->save();
                    $total = $total - ($total * $couponS[0]['coupon_number'] / 100);
                }
                if ($couponS[0]['coupon_condition'] === 2) {
                    $coupon = Coupon::where('coupon_code', $couponS[0]['coupon_code'])->first();
                    $coupon->coupon_used = $coupon->coupon_used . ',' . Session::get('customer_id');
                    $coupon->coupon_times = $coupon->coupon_times - 1;
                    $couponCode = $coupon->coupon_code;
                    $coupon->save();
                    $total = $total - $couponS[0]['coupon_number'];
                }
            }
            //get vận chuyển
            $shipping = new Shipping();
            $shipping->shipping_name = $customer['customer_name'];
            $shipping->shipping_address = $customer['customer_address'];
            $shipping->shipping_phone = $customer['customer_phone'];
            $shipping->shipping_email = $customer['customer_email'];
            $shipping->shipping_method = 2;
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
                    $order_details->product_coupon = $couponCode;
                    $order_details->product_feeship = $fee;
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
            $shipping_array = array(
                'fee' => $fee,
                'customer_name' => $customer->name,
                'shipping_name' => $customer['customer_name'],
                'shipping_email' => $customer['customer_email'],
                'shipping_phone' => $customer['customer_phone'],
                'shipping_address' => $customer['customer_address'],
                'shipping_method' => 2,
            );
            $ordercode_mail = array(
                'coupon_code' => $couponCode,
                'order_code' => $checkout_code,
                'total' => $total,
            );
            Mail::send('pages.mail.mail_order', ['cart_array' => $cart_array, 'shipping_array' => $shipping_array, 'code' => $ordercode_mail], function ($message) use ($title_mail, $data) {
                $message->to($data['email'])->subject($title_mail);
                $message->from($data['email'], $title_mail);
            });
            Session::forget('cart');
            Session::forget('coupon');
            Session::forget('fee');
            return redirect('/home')->with('message', 'Bạn đã thanh toán thành công');
        }
    }
}
