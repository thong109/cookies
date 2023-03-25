<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Commons\CodeMasters\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExports;
use App\Exports\WordImport as ExportsWordImport;
use App\Imports\ProductImports;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Gallery;
use Illuminate\Support\Facades\File;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Rating;

// session_start();

class ProductController extends Controller
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

    public function product()
    {
        $this->check();
        $products = Product::get();
        return view('admin.product.product', compact('products'));
    }

    public function createProduct()
    {
        $this->check();
        $brands = Brand::where('status', Status::SHOW())->get();
        $status = Status::toArray();
        $isInsert = true;
        return view('admin.product.productDetail', compact('brands', 'status', 'isInsert'));
    }

    public function insertProduct(Request $request)
    {
        $this->check();
        $data = $request->all();
        $product = new Product();
        $product->name = $data['name'];
        $product->slug = SlugController::slugify($data['name']);
        $product->description = $data['description'];
        $product->content = $data['content'];
        $product->status = $data['status'];
        $product->tags = $data['tags'];
        $product->price = $data['price'];
        $product->cost = $data['cost'];
        $product->sale = $data['sale'];
        $product->quantity = $data['quantity'];
        $product->brand_id = $data['brand'];
        $product->code =  'CK_' . substr(md5(microtime()), rand(0, 25), 9);
        $files = $request->file('image');
        if ($files != "") {
            $path_gal = 'public/gallery/';
            $fileImage = $files->getClientOriginalName();
            $nameImage = str_replace([' ', '-'], '_', current(explode('.', $fileImage)));
            $newImage = $nameImage . '-' . rand(0, 99) . '.' . $files->getClientOriginalExtension();
            $image = '/camera/public/imgs/product/' . $newImage;
            $files->move(public_path('imgs/product'), $newImage);
            File::copy(public_path('imgs/product/') . $newImage, $path_gal . $newImage);
        }
        $product->image = $image;
        $product->save();

        $gallery = new Gallery();
        $gallery->gallery_image = $newImage;
        $gallery->gallery_name = $newImage;
        $gallery->product_id = $product->id;
        $gallery->save();

        return response()->json([
            'data' => $product
        ]);
    }

    public function changeStatus(Request $request)
    {
        $this->check();
        $id = $request['id'];
        $product = Product::where('id', $id)->first();
        if ($product['status'] == 0) {
            $product->status = 1;
            $product->save();
            return Redirect::to('product');
        }
        $product->status = 0;
        $product->save();
        return Redirect::to('product');
    }

    public function editProduct($id)
    {
        $this->check();
        $pro = Product::find($id);
        if (!isset($pro) || empty($pro)) {
            return view('pages.error.404');
        }
        $brands = Brand::where('status', Status::SHOW())->get();
        $status = Status::toArray();
        $isInsert = false;
        return view('admin.product.productDetail', compact('pro', 'status', 'isInsert', 'brands'));
    }

    public function updateProduct(Request $request, $id)
    {
        $this->check();
        $data = $request->all();
        $product = Product::find($id);
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->content = $data['content'];
        $product->status = $data['status'];
        $product->tags = $data['tags'];
        $product->price = $data['price'];
        $product->cost = $data['cost'];
        $product->sale = $data['sale'];
        $product->quantity = $data['quantity'];
        $product->brand_id = $data['brand'];
        $files = $request->file('image');
        $oldImage = null;
        if (!is_null($files)) {
            $oldImage = public_path() . $product->image;
            $fileImage = $files->getClientOriginalName();
            $nameImage = str_replace([' ', '-'], '_', current(explode('.', $fileImage)));
            $newImage = $nameImage . '-' . rand(0, 99) . '.' . $files->getClientOriginalExtension();
            $image = '/camera/public/imgs/product/' . $newImage;
            $files->move(public_path('imgs/product'), $newImage);
            $product->image = $image;
        }
        $product->save();
        if ($oldImage != null) {
            $img = explode('/camera/public', $oldImage);
            $image = public_path() . $img[1];
            if (file_exists($image)) {
                unlink($image);
            }
        }
        return response()->json([
            'data' => $product
        ]);
    }

    public function deleteProduct(Request $request)
    {
        $this->check();
        $id = $request['id'];
        $product = Product::where('id', $id)->first();
        Gallery::where('product_id', $id)->delete();
        Product::where('id', $id)->delete();
        if (isset($product->image) || !empty($product->image)) {
            $img = explode('/camera/public', $product->image);
            $image = public_path() . $img[1];
            if (isset($product->image) || !empty($product->image)) {
                if (file_exists($image)) {
                    unlink($image);
                }
            }
        }
        return Redirect::to('product');
    }

    //End Admin
    public function productDetail($slug, Request $request)
    {
        $productDetail = Product::with('gallery')->where('tbl_product.slug', $slug)->where('status', Status::SHOW())
            ->first();
        if (!isset($productDetail)) {
            return view('pages.error.404');
        }
        $brands = Brand::where('status', Status::SHOW())->orderBy('id', 'desc')->whereNotIn('id', [21, 25])->get();
        //update views product
        $productDetail->views = $productDetail->views + 1;
        $productDetail->save();

        $nextProdId = Product::where('id', '>', $productDetail->id)->min('id');
        $nextPro = Product::where('id', $nextProdId)->first();
        $preProdId = Product::where('id', '<', $productDetail->id)->max('id');
        $prePro = Product::where('id', $preProdId)->first();
        $relatedProduct = Product::where('tbl_product.brand_id', $productDetail['brand_id'])->whereNotIn('tbl_product.slug', [$slug])->limit(6)
            ->get();
        // $rating = Rating::where('rating_id', $productDetail['id'])->avg('rating');
        $wishlist = Favorite::where('user_id', Session::get('customer_id'))->where('product_id', $productDetail['id'])->count();
        $comments = Comment::where('comment_product_id', $productDetail->id)->get();
        // $rating = number_format($rating, 2, '.', '');
        return view('pages.product.showProduct', compact('prePro', 'nextPro', 'brands', 'productDetail', 'relatedProduct', 'wishlist', 'comments'));
    }

    public function export_product()
    {
        return Excel::download(new ProductExports, 'product_product.xlsx');
    }

    public function import_product(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        Excel::import(new ProductImports, $path);
        return back();
    }
    public function import_word(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExportsWordImport, $path);
        return back();
    }
    public function quickview(Request $request)
    {
        $product = Product::find($request['product_id'])->leftJoin("tbl_brand", 'tbl_product.brand_id', '=', 'tbl_brand.id')->select('tbl_product.*', 'tbl_brand.name as nameBrand')->first();
        $gallery = Gallery::where('product_id', $request['product_id'])->get();
        return response()->json([
            'code' => 200,
            'product' => $product,
            'gallery' => $gallery
        ]);
    }

    public function load_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id', $product_id)
            // ->where('comment_parent_comment',null)
            ->get();
        $output = '';
        foreach ($comment as $key => $comment) {
            $output .= '
                <div class="row style_comment">
                    <div class="col-md-2">
                        <img src="public/fronent/images/" alt="">
                    </div>
                    <div class="col-md-10">
                        <p style="color: blue">' . $comment->comment_name . '</p>
                        <p>' . $comment->comment . '</p>
                    </div>
                </div>
                <p></p>
                ';
            if ($comment->comment_parent_comment != null) {
                $output .= '
                    <div class="row comment_reply style_comment">
                    <div class="col-md-2">
                        <img src="public/fronent/images/" alt="">
                    </div>
                    <div class="col-md-10">
                        <p style="color: blue">' . $comment->comment_name . '</p>
                        <p>' . $comment->comment . '</p>
                    </div>
                </div>
                <p></p>
                    ';
            }
        }
        echo $output;
    }
    public function send_comment(Request $request)
    {
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->comment_name = $request->comment_name;
        $comment->comment_email = $request->comment_email;
        $comment->customer_id = $request->customer_id;
        $comment->comment_product_id = $request->comment_product_id;
        $comment->rating = $request->rating;
        $comment->save();
        return redirect()->back();
    }
    //Admin
    public function list_comment()
    {
        $this->check();
        $comment = Comment::with('product')
            ->OrderBy('comment_date', 'desc')
            ->where('comment_parent_comment', null)
            ->get();
        return view('admin.comment.list_comment')->with(compact('comment'));
    }
    // public function delete_comment($comment_id){
    //     $comment = Comment::findOrFail($comment_id);
    //     $result = $comment->delete();
    //     if($result){
    //         Session::put('message','Xóa mã giảm giá thành công');
    //         return Redirect::to('list-comment');
    //     }else{
    //         Session::put('message','Xóa mã giảm giá thất bại');
    //         return Redirect::to('list-comment');
    //     }
    // }
    public function reply_comment(Request $request)
    {
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_name = "thedogshop.net";
        $comment->save();
    }
    // public function allow_comment(Request $request){
    //     $data = $request->all();
    //     $comment = Comment::find($data['comment_id']);
    //     $comment->comment_status = $data['comment_status'];
    //     $comment->save();
    // }
    public function insert_rating(Request $request)
    {
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }

    public function wishlist()
    {
        if (!Session::get('customer_id')) {
            return Redirect::to('/account/login');
        } else {
            return view('pages.wishlist.wishlist');
        }
    }

    public function fetchWishlist()
    {
        $wishlists = Favorite::whereHas('wishlist', function ($q) {
            $q->where('tbl_product.status', Status::SHOW());
        })
            ->with('wishlist')
            ->where('tbl_favorite.user_id', Session::get('customer_id'))
            ->get();
        return response()->json([
            'data' => $wishlists
        ]);
    }

    public function addWishlist(Request $request)
    {
        if (Session::get('customer_id')) {
            $check = Favorite::where('product_id', $request['id'])->where('user_id', Session::get('customer_id'))->count();
            if ($check > 0) {
                return response()->json([
                    'code' => 400
                ]);
            }
            $wishlist = new Favorite();
            $wishlist->product_id = $request['id'];
            $wishlist->user_id = Session::get('customer_id');
            $wishlist->save();

            return response()->json([
                'mgS' => 'S000',
                'code' => 200
            ]);
        }
        return response()->json([
            'mgS' => 'E402',
            'code' => 402
        ]);
    }

    public function deleteWishlist(Request $request)
    {
        $data = $request->all();
        Favorite::where('id', $data['id'])->delete();
        return response()->json([
            'code' => 200
        ]);
    }
}
