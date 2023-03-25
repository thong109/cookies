<?php

namespace App\Http\Controllers;

use App\Commons\CodeMasters\Status;
use App\Commons\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Danhmuc;
use App\Models\Favorite;
use Illuminate\Support\Facades\Session;

// session_start();

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Danhmuc::where('status', Status::SHOW())->get();
        $brands = Brand::whereNotIn('id', Constants::DIFFERENT())->get();
        $pet = Product::where('status', Status::SHOW())->where('id', Constants::CHO_MEO_CANH())->orderBy('id', 'desc')->get();
        $accessory = Product::where('status', Status::SHOW())->where('id', 23)->orderBy('id', 'desc')->get();
        $spa = Product::where('status', Status::SHOW())->where('id', 24)->orderBy('id', 'desc')->get();
        $product = Product::where('status', Status::SHOW())->orderBy('id', 'desc')->get();
        $food = Product::with('brands')->where('status', Status::SHOW())->orderByDesc('price')->get();
        $wishlist = Favorite::where('user_id', Session::get('customer_id'))->get();
        // $banner = DB::table('tbl_banner')->where('banner_status', '0')->orderBy('banner_id', 'desc')->limit(1)->get();
        // $all_slider = DB::table('tbl_slider')->where('slider_status', '0')->orderBy('slider_id', 'desc')->limit(5)->get();
        // $all_sponsor = DB::table('tbl_sponsor')->where('sponsor_status', '0')->orderBy('sponsor_id', 'desc')->limit(4)->get();
        // $all_course = DB::table('tbl_course')->where('course_status', '0')->orderBy('course_id', 'desc')->limit(6)->get();
        // $all_activity = Activity::where('activity_status', '0')->orderBy('activity_id', 'desc')->limit(6)->get();
        $blogs = Blog::leftJoin('tbl_admin', 'tbl_admin.admin_id', '=', 'blogs.created_by')
            ->select('blogs.*', 'tbl_admin.admin_name as author')->get();
        return view('pages.index')->with(compact('categories', 'spa', 'pet', 'accessory', 'food', 'brands', 'product', 'wishlist', 'blogs'));
        // test
    }

    // public function activity(Request $request)
    // {
    //     $meta_desc = "Chuyên bán máy ảnh và phụ kiện máy ảnh";
    //     $meta_keywords = "may anh, máy ảnh, phụ kiện,phu kien, phụ kiện máy ảnh, phu kien may anh";
    //     $meta_title = "thedogshop.net | Tin tức";
    //     $url_canonical = $request->url();
    //     $all_activity = Activity::where('activity_status', '0')->orderBy('activity_id', 'desc')->limit(6)->get();
    //     return view('pages.activity')->with('activity', $all_activity)->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical'));
    // }
    // public function sponsor()
    // {
    //     $all_sponsor = DB::table('tbl_sponsor')->where('sponsor_status', '0')->orderBy('sponsor_id', 'desc')->limit(6)->get();
    //     return view('pages.sponsor')->with('sponsor', $all_sponsor);
    // }
    // public function course()
    // {
    //     $all_course = DB::table('tbl_course')->where('course_status', '0')->orderBy('course_id', 'desc')->limit(6)->get();
    //     // $all_news = DB::table('tbl_news')->where('news_status','0')->orderBy('news_id','desc')->limit(6)->get();
    //     return view('pages.course')->with('course', $all_course)->with('news');
    // }

    // public function autocomplete_ajax(Request $request)
    // {
    //     $data = $request->all();
    //     if ($data['query']) {
    //         $product = Product::where('product_status', 0)->where('product_name', 'like', '%' . $data['query'] . '%')->get();
    //         $output = '<ul class="dropdown-menu" style="display:block;width:100%">';
    //         foreach ($product as $key => $word) {
    //             $output .= '
    //                 <li class="li_search_ajax"><a href="#.">' . $word->product_name . '</a></li>
    //             ';
    //         }
    //         $output .= '</ul>';
    //         echo $output;
    //     }
    // }

    public function search(Request $request)
    {
        $data = $request->all();
        $categories = Danhmuc::with('brands')
            ->where('status', Status::SHOW())->orderBy('id', 'desc')->get();
        $bestSaller = Product::join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.id')
            ->select('tbl_product.*', 'tbl_brand.name as brandName')->orderByDesc('sold')->limit(4)->get();
        $query = Product::leftJoin("tbl_brand", 'tbl_product.brand_id', '=', 'tbl_brand.id')
            ->leftJoin('tbl_danhmuc', 'tbl_brand.category_id', '=', 'tbl_danhmuc.id')
            ->where('tbl_product.status', Status::SHOW())
            ->where('tbl_brand.status', Status::SHOW())
            ->where('tbl_danhmuc.status', Status::SHOW())
            ->select('tbl_product.*', 'tbl_brand.name as brandName', 'tbl_danhmuc.slug as danhmucSlug');
        $wishlist = Favorite::where('user_id', Session::get('customer_id'))->get();
        if (isset($data['keyword'])) {
            $keyword = $data['keyword'];
            $search = true;
            $productByCategory = $query
                ->where('tbl_product.name', 'like', '%' . $data['keyword'] . '%')
                ->orWhere('tbl_product.tags', 'like', '%' . $data['keyword'] . '%')
                ->paginate(12);
            return view('pages.category.productByCategory')->with(compact('keyword', 'search', 'categories', 'productByCategory', 'bestSaller', 'wishlist'));
        }
        if (isset($data['category'])) {
            $category = Danhmuc::where('slug', $data['category'])->first();
            $productByCategory = $query->where('tbl_danhmuc.slug', $data['category'])
                ->paginate(12);
            $search = false;
            return view('pages.category.productByCategory', compact('categories', 'productByCategory', 'bestSaller', 'search', 'category', 'wishlist'));
        }
        if (isset($data['brand'])) {
            $productByCategory = $query->where('tbl_brand.slug', $data['brand'])
                ->paginate(12);
            $search = false;
            return view('pages.category.productByCategory', compact('categories', 'productByCategory', 'bestSaller', 'search', 'wishlist'));
        }
        $productByCategory = $query->paginate(12);
        $search = false;
        return view('pages.category.productByCategory', compact('search', 'categories', 'bestSaller', 'productByCategory', 'wishlist'));
    }
}
