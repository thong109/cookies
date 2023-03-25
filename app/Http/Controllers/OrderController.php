<?php

namespace App\Http\Controllers;

use App\Commons\Constants;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Shipping;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\Support\Facades\URL;

class OrderController extends Controller
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
    public function manageOrder()
    {
        $this->check();
        $orders = Order::orderby('created_at', 'desc')->get();
        return view('admin.manager.managerOrder', compact('orders'));
    }
    public function view_order($order_code)
    {
        $order_details = OrderDetail::where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        // $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $order_details_pro = OrderDetail::with('product')->where('order_code', $order_code)->get();

        foreach ($order_details_pro as $key => $order_d) {
            $product_coupon = $order_d->product_coupon;
        }
        if ($product_coupon != 'no') {
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        } else {
            $coupon_condition = 2;
            $coupon_number = 0;
        }

        return view('admin.manager.orderDetail', compact('order_details', 'order_details_pro', 'shipping', 'coupon_condition', 'coupon_number', 'order'));
    }
    public function delete_order($order_code)
    {
        $code_del = Order::find($order_code);
        $code_del->delete();
        return redirect()->back();
    }
    public function print_order($checkout_code)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }

    public function print_order_convert($checkout_code)
    {
        $order_details = OrderDetail::with('product')->where('order_code', $checkout_code)->get();
        $order = Order::where('order_code', $checkout_code)->get();
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $order_details_pro = OrderDetail::with('product')->where('order_code', $checkout_code)->get();
        foreach ($order_details_pro as $key => $order_d) {
            $product_coupon = $order_d->product_coupon;
        }
        if ($product_coupon != 'no') {
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        } else {
            $coupon_condition = 2;
            $coupon_number = 0;
        }
        $output = '';

        $output .= '<style>
                body{
                    font-family: Dejavu Sans;
                }
                table{
                    width: 100%;
                }
                table, tr, td,th {
                    border: 1px solid;
                    border-collapse: collapse;
                }
                td {
                    padding: 5px;
                    font-size:12px;
                }
                th{
                    padding:0;
                    font-size:12px;
                }
                table thead .nocolor{
                    border: 1px solid white !important;
                    border-collapse: unset !important;
                }
                img{
                    width:50px;
                }
                </style>
                <center>
                    <h1>The Dog Shop</h1>
                </center>';

        $output .= '
        <h4>Thông tin khách hàng</h4>
        <table class="table-styling">
            <tr>
                <th>Tên người nhận</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Ghi chú</th>
            </tr>
        <tbody>';
        $output .= '
                <tr>
                    <td>' . $shipping->shipping_name . '</td>
                    <td>' . $shipping->shipping_address . '</td>
                    <td>' . $shipping->shipping_phone . '</td>
                    <td>' . $shipping->shipping_email . '</td>
                    <td>' . $shipping->shipping_notes . '</td>
                </tr>';
        $output .= '
        </tbody>
        </table>
        ';
        $output .= '
        <h4>Đơn hàng đặt</h4>
        <table class="table-styling">
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá sản phẩm</th>
                    <th>Thành tiền</th>
                </tr>
            <tbody>';
        $total = 0;
        foreach ($order_details_pro as $key => $pro) {
            $subtotal = $pro->product_price * $pro->product_sales_quantity;
            $total += $subtotal;
            if ($pro->product_coupon != 'no') {
                $product_coupon = $pro->product_coupon;
            } else {
                $product_coupon = 'Đơn hàng không áp dụng mã giảm giá';
            }
            $output .= '
                <tr>
                    <td>' . $pro->product_name . '</td>
                    <td><center>' . number_format($pro->product_sales_quantity) . '</center></td>
                    <td>' . number_format($pro->product_price) . ' VND' . '</td>
                    <td>' . number_format($subtotal) . ' VND' . '</td>
                </tr>';
        }
        if ($coupon_condition == 1) {
            $method = 'Giảm theo %';
            $total_after_coupon = ($total * $coupon_number) / 100;
            $total_coupon = $total - $total_after_coupon + $pro->product_feeship;
        } else {
            $total_coupon = $total - $coupon_number + $pro->product_feeship;
            $method = 'Giảm theo tiền';
        }

        $output .= '
                <tr class="border">
                    <th>Mã giảm giá</th>
                    <th>Phương thức giảm</th>
                    <th colspan="2">Thanh toán</th>
                    </tr>
                    <tr>
        ';
        $output .= '
                    <td><center>' . $product_coupon . '</center></td>
                    <td><center>' . $method . '</center></td>
                    <td colspan="2">
                        <p>Tổng giảm : ' . number_format($coupon_number) . ' VND' . '</p>
                        <p>Phí ship : ' . number_format($pro->product_feeship) . ' VND' . '</p>
                        <p>Tổng tiền : ' . number_format($total_coupon) . ' VND' . '</p>
                    </td>
                </tr>
                </tbody>
        </table>
        <br><br>
            <table>
                <thead>
                    <tr class="nocolor">
                        <th class="nocolor" width:"200px">
                        Huế, ngày...tháng...năm...<br>
                        Người lập phiếu</th>
                        <th class="nocolor" width:"800px">
                        Huế, ngày...tháng...năm...<br>
                        Người nhận</th>
                    </tr>
                </thead>';
        $output .= '
            </table>';
        return $output;
    }

    public function update_order_qty(Request $request)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $webName = Constants::WEBNAME();
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $customer = Customer::where('customer_id', $order->customer_id)->first();
        $order->order_status = $data['order_status'];
        $order->save();
        //order date
        $order_date = $order->order_date;
        $statistic = Statistic::where('order_date', $order_date)->get();
        if ($statistic) {
            $statistic_count = $statistic->count();
        } else {
            $statistic_count = 0;
        }
        if ($order->order_status == 2) {
            $total_order = 0;
            $sales = 0;
            $profit = 0;
            $quantity = 0;
            foreach ($data['order_product_id'] as $key => $id) {
                $product = Product::find($id);
                $product_quantity = $product->quantity;
                $product_sold = $product->sold;
                //them
                $product_price = $product->price - ($product->price * $product->sale) / 100;
                $product_cost = $product->cost;
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                //
                foreach ($data['product_sale_quantity'] as $key2 => $qty) {
                    if ($key == $key2) {
                        $product_remain = $product_quantity - $qty;
                        $product->quantity = $product_remain;
                        $product->sold = $product_sold + $qty;
                        $product->save();
                        //update doanh thu
                        $quantity += $qty;
                        $total_order += 1;
                        $sales += $product_price * $qty;
                        $profit = $sales - ($product_cost * $qty);
                    }
                }
            }
            if ($statistic_count > 0) {
                $statistic_update = Statistic::where('order_date', $order_date)->first();
                $statistic_update->sales = $statistic_update->sales + $sales;
                $statistic_update->profit = $statistic_update->profit + $profit;
                $statistic_update->quantity = $statistic_update->quantity + $quantity;
                $statistic_update->total_order = $statistic_update->total_order + $total_order;
                $statistic_update->save();
            } else {
                $statistic_new = new Statistic();
                $statistic_new->order_date = $order_date;
                $statistic_new->sales = $sales;
                $statistic_new->profit = $profit;
                $statistic_new->quantity = $quantity;
                $statistic_new->total_order = $total_order;
                $statistic_new->save();
            }
            $title_mail = "Đơn hàng đã được giao vào lúc" . ' ' . $now;
            Mail::send('pages.mail.mail_success', ['content' => $title_mail], function ($message) use ($webName, $customer) {
                $message->to($customer['customer_email'])->subject($webName);
                $message->from($customer['customer_email'], $webName);
            });
            return response()->json([
                'code' => 200
            ]);
        }
        if ($order->order_status == 3) {
            $title_mail = "Đơn hàng của bạn đã bị huỷ do không đủ số lượng hàng trong kho";
            Mail::send('pages.mail.mail_success', ['content' => $title_mail], function ($message) use ($webName, $customer) {
                $message->to($customer['customer_email'])->subject($webName);
                $message->from($customer['customer_email'], $webName);
            });
            return response()->json([
                'code' => 'S017'
            ]);
        }
    }

    public function history(Request $request)
    {
        if (!Session::get('customer_id')) {
            return redirect('login-checkout')->with('message', 'bạn phải đăng nhập mới xem được lịch sử mua hàng');
        } else {
            $historyOrder = Order::where('customer_id', Session::get('customer_id'))->Orderby('order_id', 'desc')->get();
            return view('pages.history.history', compact('historyOrder'));
        }
    }

    public function orderDetail($order_code)
    {
        if (!Session::get('customer_id')) {
            return redirect('login-checkout');
        }

        //Xem lịch sử
        $order_details = OrderDetail::with('product')->where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->first();
        $customer_id = $order->customer_id;
        $shipping_id = $order->shipping_id;
        $order_status = $order->order_status;
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $order_details_pro = OrderDetail::with('product')->where('order_code', $order_code)->get();

        foreach ($order_details_pro as $key => $order_d) {
            $product_coupon = $order_d->product_coupon;
        }
        if ($product_coupon != 'no') {
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        } else {
            $coupon_condition = 2;
            $coupon_number = 0;
        }
        // dd($coupon->coupon_condition);
        return view('pages.history.detail_history', compact('coupon_number', 'coupon_condition', 'order_details', 'customer', 'shipping', 'order', 'order_details_pro'));
    }
}
