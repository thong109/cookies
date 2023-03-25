<?php

namespace App\Http\Controllers;

use App\Commons\CodeMasters\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Exports\ExcelExports;
use App\Imports\ExcelImports;
use App\Models\Brand;
use App\Models\Danhmuc;
use Maatwebsite\Excel\Facades\Excel;

// session_start();

class CategoryProduct extends Controller
{
    public function check(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function createBrand()
    {
        $this->check();
        $status = Status::toArray();
        $isInsert = true;
        $categories = Danhmuc::where('status',Status::SHOW())->get();
        return view('admin.brand.brandDetail',compact('status','isInsert','categories'));
    }
    public function brand()
    {
        $this->check();
        $brands = Brand::orderBy('id', 'desc')->get();
        return view('admin.brand.brand', compact('brands'));
    }
    public function save_category(Request $request)
    {
        $this->check();
        $data = $request->all();
        $category = new Brand();
        $category->category_name = $data['category_name'];
        $category->category_desc = $data['category_desc'];
        $category->category_status = $data['category_status'];
        $category->category_slug = $data['category_slug'];
        $category->save();

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['category_desc'] = $request->category_desc;
        // $data['category_status'] = $request->category_status;
        // DB::table('tbl_category')->insert($data);
        Session::put('message','Thêm thành công');
        return Redirect::to('all-category');
    }
    public function unactive_category($category_id){
        $this->check();
        Brand::where('category_id',$category_id)->update(['category_status'=>1]);
        return Redirect::to('all-category');
    }
    public function active_category($category_id){
        $this->check();
        Brand::where('category_id',$category_id)->update(['category_status'=>0]);
        return Redirect::to('all-category');
    }
    public function edit_category($category_id){
        $this->check();
        // $edit_category = DB::table('tbl_category')->where('category_id',$category_id)->get();
        $edit_category = Brand::find($category_id);
        // $edit_category = Brand::where('category_id',$category_id)->get();

        $manager_category = view('admin.category.edit_category')->with('edit_category',$edit_category);
        return view('admin_layout')->with('admin.category.edit_category',$manager_category);
    }
    public function update_category(Request $request,$category_id){
        $this->check();
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['category_desc'] = $request->category_desc;
        $data = $request->all();
        $category = Brand::find($category_id);
        $category->category_name = $data['category_name'];
        $category->category_desc = $data['category_desc'];
        $category->category_slug = $data['category_slug'];
        $category->category_status = 1;
        $category->save();
        // DB::table('tbl_category')->where('category_id',$category_id)->update($data);
        return Redirect::to('all-category');
    }
    public function delete_category($category_id){
        $this->check();
        Brand::where('category_id',$category_id)->delete();
        return Redirect::to('all-category');
    }

    public function export_csv(){
        return Excel::download(new ExcelExports ,'category_product.xlsx');
    }
    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImports, $path);
        return back();
    }
}
