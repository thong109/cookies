<?php

namespace App\Http\Controllers;

use App\Commons\CodeMasters\Status;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Login;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\Social;
use App\Models\Statistic;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// session_start();
class AdminController extends Controller
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
    public function index()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('thongke');
        } else {
            return view('admin_login');
        }
    }

    public function showdashboard(Request $request)
    {
        $this->check();
        $user_ip_address = $request->ip();
        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')
            ->subMonth()
            ->startOfMonth()
            ->toDateString();
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')
            ->subMonth()
            ->endOfMonth()
            ->toDateString();
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')
            ->startOfMonth()
            ->toDateString();
        $oneyears = Carbon::now('Asia/Ho_Chi_Minh')
            ->subDays(365)
            ->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        //total last month
        $visitor_of_lastmonth = Visitor::whereBetween('date_visitors', [$early_last_month, $end_of_last_month])->get();
        $visitor_last_month_count = $visitor_of_lastmonth->count();
        //total this month
        $visitor_of_thismonth = Visitor::whereBetween('date_visitors', [$early_this_month, $now])->get();
        $visitor_this_month_count = $visitor_of_thismonth->count();
        //total in one year
        $visitor_of_year = Visitor::whereBetween('date_visitors', [$oneyears, $now])->get();
        $visitor_of_year_count = $visitor_of_year->count();
        //total online
        $visitor_of_current = Visitor::where('ip_address', $user_ip_address)->get();
        $visitor_count = $visitor_of_current->count();
        if ($visitor_count < 1) {
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitors = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }
        //total visitor
        $visitor = Visitor::all();
        $visitor_total = $visitor->count();
        //total
        $product = Product::all()->count();
        // $product_views = Product::orderBy('product_views','desc')->take(20)->get();
        $order = Order::all()->count();
        $customer = Customer::all()->count();
        return view('admin.thongke')->with(compact('visitor_last_month_count', 'visitor_this_month_count', 'visitor_of_year_count', 'visitor_of_year_count', 'visitor_total', 'product', 'order', 'customer', 'visitor_count'));
    }

    public function donut()
    {
        $product = Product::all()->count();
        $appOrder = Order::all()->count();
        $appCustomer = Customer::all()->count();
        return response()->json([
            'product' => $product,
            'appOrder' => $appOrder,
            'appCustomer' => $appCustomer,
        ]);
    }

    public function dashboard(Request $request)
    {
        $data = $request->all();
        $admin_email = $data['admin_email'];
        $admin_password = $data['admin_password'];
        $login = Login::where('admin_email', $admin_email)
            ->where('admin_password', $admin_password)
            ->first();
        if ($login) {
            $login_count = $login->count();
            if ($login_count > 0) {
                Session::put(['admin_name' => $login->admin_name]);
                Session::put(['admin_id' => $login->admin_id]);
                Session::put(['role_id' => $login->role_id]);
                return Redirect::to('/thongke');
            }
        } else {
            Session::put('message', 'Làm ơn nhập lại');
            return Redirect::to('/admin');
        }
    }
    public function logout()
    {
        $this->check();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
    //
    public function thongke(Request $request)
    {
        $this->check();
        $user_ip_address = $request->ip();
        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')
            ->subMonth()
            ->startOfMonth()
            ->toDateString();
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')
            ->subMonth()
            ->endOfMonth()
            ->toDateString();
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')
            ->startOfMonth()
            ->toDateString();
        $oneyears = Carbon::now('Asia/Ho_Chi_Minh')
            ->subDays(365)
            ->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        //total last month
        $visitor_of_lastmonth = Visitor::whereBetween('date_visitors', [$early_last_month, $end_of_last_month])->get();
        $visitor_last_month_count = $visitor_of_lastmonth->count();
        //total this month
        $visitor_of_thismonth = Visitor::whereBetween('date_visitors', [$early_this_month, $now])->get();
        $visitor_this_month_count = $visitor_of_thismonth->count();
        //total in one year
        $visitor_of_year = Visitor::whereBetween('date_visitors', [$oneyears, $now])->get();
        $visitor_of_year_count = $visitor_of_year->count();
        //total online
        $visitor_of_current = Visitor::where('ip_address', $user_ip_address)->get();
        $visitor_count = $visitor_of_current->count();
        if ($visitor_count < 1) {
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitors = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }
        //total visitor
        $visitor = Visitor::all();
        $visitor_total = $visitor->count();
        //total
        $product = Product::all()->count();
        $app_order = Order::all()->count();
        $app_customer = Customer::all()->count();
        // $product_views = Product::orderByRaw('CONVERT(views, SIGNED) desc')->paginate(5);
        //Lấy kho hàng
        $getAllProduct = Product::orderByRaw('CONVERT(views, SIGNED) desc')->paginate(5);
        //Thống kê tổng doanh thu
        //Lấy dữ liệu ngày tháng
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')
            ->startOfMonth()
            ->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $dau_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')
            ->subMonth()
            ->startOfMonth()
            ->toDateString();
        $cuoi_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')
            ->subMonth()
            ->endOfMonth()
            ->toDateString();
        $sub7ngay = Carbon::now('Asia/Ho_Chi_Minh')
            ->subDays(7)
            ->toDateString();
        $sub365ngay = Carbon::now('Asia/Ho_Chi_Minh')
            ->subDays(365)
            ->toDateString();
        //Tính doanh thu
        $get7ngay = Statistic::whereBetween('order_date', [$sub7ngay, $now])
            ->orderBy('order_date', 'asc')
            ->sum('profit');
        $getthangnay = Statistic::whereBetween('order_date', [$dauthangnay, $now])
            ->orderBy('order_date', 'asc')
            ->sum('profit');
        $getthangtruoc = Statistic::whereBetween('order_date', [$dau_thang_truoc, $cuoi_thang_truoc])
            ->orderBy('order_date', 'asc')
            ->sum('profit');
        $get1nam = Statistic::whereBetween('order_date', [$sub365ngay, $now])
            ->orderBy('order_date', 'asc')
            ->sum('profit');
        return view('admin.thongke.thongke')->with(compact('get1nam', 'get7ngay', 'getthangtruoc', 'getthangnay', 'getAllProduct', 'visitor_last_month_count', 'visitor_this_month_count', 'visitor_of_year_count', 'visitor_of_year_count', 'visitor_total', 'product', 'app_order', 'app_customer', 'visitor_count'));
    }
    public function filter_by_date(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Statistic::whereBetween('order_date', [$from_date, $to_date])
            ->OrderBy('order_date', 'asc')
            ->get();
        foreach ($get as $key => $val) {
            $chart_data[] = [
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity,
            ];
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request)
    {
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')
            ->startOfMonth()
            ->toDateString();
        $dau_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')
            ->subMonth()
            ->startOfMonth()
            ->toDateString();
        $cuoi_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')
            ->subMonth()
            ->endOfMonth()
            ->toDateString();
        $sub7ngay = Carbon::now('Asia/Ho_Chi_Minh')
            ->subDays(7)
            ->toDateString();
        $sub365ngay = Carbon::now('Asia/Ho_Chi_Minh')
            ->subDays(365)
            ->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if ($data['dashboard_value'] == '7ngay') {
            $get = Statistic::whereBetween('order_date', [$sub7ngay, $now])
                ->orderBy('order_date', 'asc')
                ->get();
        } elseif ($data['dashboard_value'] == 'thangtruoc') {
            $get = Statistic::whereBetween('order_date', [$dau_thang_truoc, $cuoi_thang_truoc])
                ->orderBy('order_date', 'asc')
                ->get();
        } elseif ($data['dashboard_value'] == 'thangnay') {
            $get = Statistic::whereBetween('order_date', [$dauthangnay, $now])
                ->orderBy('order_date', 'asc')
                ->get();
        } else {
            $get = Statistic::whereBetween('order_date', [$sub365ngay, $now])
                ->orderBy('order_date', 'asc')
                ->get();
        }
        foreach ($get as $key => $val) {
            $chart_data[] = [
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity,
            ];
        }
        echo $data = json_encode($chart_data);
    }

    public function day_orders(Request $request)
    {
        $data = $request->all();
        $sub60ngay = Carbon::now('Asia/Ho_Chi_Minh')
            ->subDay(60)
            ->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistic::whereBetween('order_date', [$sub60ngay, $now])
            ->orderBy('order_date', 'asc')
            ->get();
        foreach ($get as $key => $val) {
            $chart_data[] = [
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity,
            ];
        }
        echo $data = json_encode($chart_data);
    }
    ////////////////Login customer google
    public function loginCustomerGoogle()
    {
        config(['services.google.redirect' => env('GOOGLE_CLIENT_URL')]);
        return Socialite::driver('google')->redirect();
    }
    public function CallbackCustomerGoogle()
    {
        config(['services.google.redirect' => env('GOOGLE_CLIENT_URL')]);

        $users = Socialite::driver('google')
            ->stateless()
            ->user();
        $authUser = $this->findOrCreateCustomer($users, 'google');
        if ($authUser) {
            $account_name = Customer::where('customer_id', $authUser->user)->first();
            Session::put('customer_id', $account_name->customer_id);
            Session::put('customer_picture', $account_name->customer_picture);
            Session::put('customer_name', $account_name->customer_name);
        } elseif (isset($customer_new)) {
            $account_name = Customer::where('customer_id', $authUser->user)->first();
            Session::put('customer_id', $account_name->customer_id);
            Session::put('customer_picture', $account_name->customer_picture);
            Session::put('customer_name', $account_name->customer_name);
        }
        return redirect('/')->with('message', 'Success');
    }

    public function findOrCreateCustomer($users, $provider)
    {
        $authUser = Social::where('provider_user_id', $users->id)
            ->where('provider_user_email', $users->email)
            ->first();
        if ($authUser) {
            return $authUser;
        } else {
            $customer_new = new Social([
                'provider_user_id' => $users->id,
                'provider_user_email' => $users->email,
                'provider' => strtoupper($provider),
            ]);
            $customer = Customer::where('customer_email', $users->email)->first();
            if (!$customer) {
                $customer = Customer::create([
                    'customer_name' => $users->name,
                    'customer_picture' => $users->avatar,
                    'customer_email' => $users->email,
                    'customer_password' => '',
                    'customer_phone' => '',
                    'customer_address' => '',
                ]);
            }
            $customer_new->customer()->associate($customer);
            $customer_new->save();
            return $customer_new;
        }
    }
    public function loginCustomerFacebook()
    {
        config(['services.facebook.redirect' => env('FACEBOOK_REDIRECT')]);
        return Socialite::driver('facebook')->redirect();
    }
    public function CallbackCustomerFacebook()
    {
        config(['services.facebook.redirect' => env('FACEBOOK_REDIRECT')]);
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider', 'facebook')
            ->where('provider_user_id', $provider->getId())
            ->first();
        if ($account != null) {
            $account_name = Customer::where('customer_id', $account->user)->first();
            Session::put('customer_id', $account_name->customer_id);
            Session::put('customer_name', $account_name->customer_name);
            return redirect('/')->with('message', 'Success');
        } elseif ($account == null) {
            $facebook = 'facebook';
            $customer_login = new Social([
                'provider_user_id' => $provider->getId(),
                'provider_user_email' => $provider->getEmail(),
                'provider' => strtoupper($facebook),
            ]);
            $customer = Customer::where('customer_email', $provider->getEmail())->first();
            if (!$customer) {
                $customer = Customer::create([
                    'customer_name' => $provider->getName(),
                    'customer_picture' => $provider->getAvatar(),
                    'customer_email' => $provider->getEmail(),
                    'customer_password' => '',
                    'customer_phone' => '',
                ]);
            }
            $customer_login->customer()->associate($customer);
            $customer_login->save();
            $account_new = Customer::where('customer_id', $customer_login->user)->first();
            Session::put('customer_id', $account_new->customer_id);
            Session::put('customer_name', $account_new->customer_name);
            return redirect('/')->with('message', 'Success');
        }
    }
    public function profileAdmin($admin_id)
    {
        $adminId = Session::get('admin_id');
        $profileAdmin = Admin::where('admin_id', $adminId)->first();
        return view('admin.admin.profile_admin', compact('profileAdmin'));
    }
    public function editAdmin(Request $request, $admin_id)
    {
        $adminId = Session::get('admin_id');
        $profileAdmin = Admin::where('admin_id', $adminId)->first();
        $editAdmin = Admin::find($admin_id)->first();
        $editAdmin->admin_name = $request->admin_name;
        $editAdmin->admin_phone = $request->admin_phone;
        $editAdmin->admin_address = $request->admin_address;
        $editAdmin->admin_avatar = $request->admin_avatar;
        $result = $editAdmin->save();
        if ($result) {
            return redirect()
                ->back()
                ->with('message', 'Thay đổi thành công');
        } else {
            return redirect()
                ->back()
                ->with('message', 'Thay đổi thất bại');
        }
    }
    //Account User
    public function account()
    {
        if (Session::get('customer_id')) {
            $account = Customer::where('customer_id', Session::get('customer_id'))->first();
            $historyOrder = Order::where('customer_id', $account['customer_id'])->Orderby('order_id', 'desc')->paginate(6);
            return view('pages.user.account', compact('account', 'historyOrder'));
        }
        return Redirect::to('/home');
    }

    public function editCustomer(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->customer_name = $request->customer_name;
        $customer->customer_phone = $request->customer_phone;
        $customer->customer_address = $request->customer_address;
        //
        $get_image = $request->file('customer_picture');
        $path = 'uploads/avatar/';
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $customer->customer_picture = $new_image;
        }
        $customer->save();
    }

    public function getStaff()
    {
        $getStaff = Admin::whereNotIn('admin_id', [1])->get();
        dd($getStaff);
    }

    public function createCustomer()
    {
        $this->check();
        $status = Status::toArray();
        $isInsert = true;
        return view('admin.customer.customerDetail', compact('status', 'isInsert'));
    }

    public function insertCustomer(Request $request)
    {
        $this->check();
        $data = $request->all();
        $customer = new Customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->password = md5($data['password']);
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_address = $data['customer_address'];
        $files = $request->file('image');
        if ($files != '') {
            $fileImage = $files->getClientOriginalName();
            $nameImage = str_replace([' ', '-'], '_', current(explode('.', $fileImage)));
            $newImage = $nameImage . '-' . rand(0, 99) . '.' . $files->getClientOriginalExtension();
            $image = '/camera/public/imgs/customer/' . $newImage;
            $files->move(public_path('imgs/customer'), $newImage);
        }
        $customer->image = $image;
        $customer->save();
        return Redirect::to('customer');
    }
    //Trạng thái customer
    public function customer()
    {
        // $customer = Customer::leftJoin('tbl_order', 'tbl_customer.customer_id', '=', 'tbl_order.customer_id')
        //     ->leftJoin('tbl_order_details', 'tbl_order.order_code', '=', 'tbl_order_details.order_code')
        //     ->select('*')
        //     ->groupBy('tbl_order.customer_id')
        //     ->get();
        // dd($customer);
        $customers = Customer::select('tbl_customer.*', DB::raw("count(tbl_order.order_id) as totalOrder"), DB::raw("sum(tbl_order_details.product_price) as totalPrice"))
            ->leftJoin('tbl_order', 'tbl_customer.customer_id', '=', 'tbl_order.customer_id')
            ->leftJoin('tbl_order_details', 'tbl_order.order_code', '=', 'tbl_order_details.order_code')
            ->groupBy('tbl_customer.customer_id')
            ->get();
        return view('admin.customer.customer', compact('customers'));
    }

    public function changeStatus(Request $request)
    {
        $this->check();
        $id = $request['id'];
        $customer = Customer::where('customer_id', $id)->first();
        if ($customer['customer_vip'] == 0) {
            $customer->customer_vip = 1;
            $customer->save();
            return Redirect::to('customer');
        }
        $customer->customer_vip = 0;
        $customer->save();
        return Redirect::to('customer');
    }
}
