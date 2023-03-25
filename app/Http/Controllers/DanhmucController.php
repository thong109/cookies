<?php

namespace App\Http\Controllers;

use App\Commons\CodeMasters\Status;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Danhmuc;

use Illuminate\Http\Request;

class DanhmucController extends Controller
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

    public function category()
    {
        $this->check();
        $danhmucs = Danhmuc::orderBy('id', 'desc')->get();
        return view('admin.danhmuc.danhmuc', compact('danhmucs'));
    }

    public function createCategory()
    {
        $this->check();
        $status = Status::toArray();
        $isInsert = true;
        return view('admin.danhmuc.danhmucDetail', compact('status', 'isInsert'));
    }

    public function insertCategory(Request $request)
    {
        $this->check();
        $data = $request->all();

        $category = new Danhmuc();
        $category->name = $data['name'];
        $category->slug = SlugController::slugify($data['name']);
        $category->description = $data['description']; // $request->description;
        $category->status = $data['status'];
        $category->title = $data['title'];
        $files = $request->file('image');
        if ($files != "") {
            $fileImage = $files->getClientOriginalName();
            $nameImage = str_replace([' ', '-'], '_', current(explode('.', $fileImage)));
            $newImage = $nameImage . '-' . rand(0, 99) . '.' . $files->getClientOriginalExtension();
            $image = '/camera/public/imgs/category/' . $newImage;
            $files->move(public_path('imgs/category'), $newImage);
        }
        $category->image = $image;
        $category->save();
        return Redirect::to('category/edit/' . $category->id);
    }

    public function editCategory($id)
    {
        $this->check();
        $category = danhmuc::find($id);
        if (!isset($category) || empty($category)) {
            return view('pages.error.404');
        }
        $status = Status::toArray();
        $isInsert = false;
        return view('admin.danhmuc.danhmucDetail', compact('status', 'isInsert', 'category'));
    }
    public function updateCategory(Request $request, $id)
    {
        $this->check();
        $oldImage = null;
        $data = $request->all();
        $category = danhmuc::find($id);
        $category->name = $data['name'];
        $category->slug = SlugController::slugify($data['name']);
        $category->description = $data['description'];
        $category->title = $data['title'];
        $files = $request->file('image');
        if ($files != "") {
            $oldImage = public_path() . $category->image;
            $fileImage = $files->getClientOriginalName();
            $nameImage = str_replace([' ', '-'], '_', current(explode('.', $fileImage)));
            $newImage = $nameImage . '-' . rand(0, 99) . '.' . $files->getClientOriginalExtension();
            $image = '/camera/public/imgs/category/' . $newImage;
            $files->move(public_path('imgs/category'), $newImage);
            $category->image = $image;
        }
        $category->status = $data['status'];
        $category->save();
        if ($oldImage != null) {
            $img = explode('/camera/public', $oldImage);
            $image = public_path() . $img[1];
            if (file_exists($image)) {
                unlink($image);
            }
        }
        return Redirect::to('category/edit/' . $category->id);
    }

    public function deleteCategory(Request $request)
    {
        $this->check();
        $id = $request['id'];
        $category = Danhmuc::where('id', $id)->first();
        Danhmuc::where('id', $id)->delete();
        if (isset($category->image) || !empty($category->image)) {
            $img = explode('/camera/public', $category->image);
            $image = public_path() . $img[1];
            if (isset($category->image) || !empty($category->image)) {
                if (file_exists($image)) {
                    unlink($image);
                }
            }
        }
        return Redirect::to('category');
    }
    public function changeStatus(Request $request)
    {
        $this->check();
        $id = $request['id'];
        $category = Danhmuc::where('id', $id)->first();
        if ($category['status'] == 0) {
            $category->status = 1;
            $category->save();
            return Redirect::to('category');
        }
        $category->status = 0;
        $category->save();
        return Redirect::to('category');
    }
    //End Function
    // public function show_home($id,Request $request){
    //     $meta_description = "Chuyên bán máy ảnh và phụ kiện máy ảnh";
    //     $meta_keywords = "may anh, máy ảnh, phụ kiện,phu kien, phụ kiện máy ảnh, phu kien may anh";
    //     $meta_title = "LJShop.vn";
    //     $url_canonical = $request->url();
    //     $cate_product = danhmuc::where('status','0')->orderBy('id','description')->get();
    //     $by_id = Product::join('tbl_danhmuc','tbl_product.id','=','tbl_danhmuc.id')->where('tbl_danhmuc.id', $id)->get();
    //     $name = danhmuc::where('tbl_danhmuc.id',$id)->get();
    //     return view('pages.danhmuc.show_home')->with('danhmuc',$cate_product)->with('id',$by_id)->with('name',$name)->with(compact('meta_keywords','meta_description','meta_title','url_canonical'));
    // }
}
