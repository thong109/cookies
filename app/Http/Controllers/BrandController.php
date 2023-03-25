<?php

namespace App\Http\Controllers;

use App\Commons\CodeMasters\Status;
use App\Exports\ExcelExports;
use App\Imports\ExcelImports;
use App\Models\Brand;
use App\Models\Danhmuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class BrandController extends Controller
{
    public function check(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function brand()
    {
        $this->check();
        $brands = Brand::orderBy('id', 'desc')->get();
        return view('admin.brand.brand', compact('brands'));
    }

    public function createBrand()
    {
        $this->check();
        $status = Status::toArray();
        $isInsert = true;
        $categories = Danhmuc::where('status',Status::SHOW())->get();
        return view('admin.brand.brandDetail',compact('status','isInsert','categories'));
    }

    public function insertBrand(Request $request)
    {
        $this->check();
        $data = $request->all();
        $brand = new Brand();
        $brand->name = $data['name'];
        $brand->description = $data['description'];
        $brand->status = $data['status'];
        $brand->slug = SlugController::slugify($data['name']);
        $brand->category_id = $data['category'];
        $brand->save();

        Session::put('message','Thêm thành công');
        return Redirect::to('brand/edit/'.$brand->id);
    }

    public function changeStatus(Request $request){
        $this->check();
        $id = $request['id'];
        $brand = Brand::where('id', $id)->first();
        if($brand['status'] == 0){
            $brand->status = 1;
            $brand->save();
        return Redirect::to('brand');
        }
        $brand->status = 0;
        $brand->save();
        return Redirect::to('brand');
    }

    public function editBrand($id){
        $this->check();
        $brand = Brand::find($id);
        if (!isset($brand) || empty($brand)) {
            return view('pages.error.404');
        }
        $status = Status::toArray();
        $isInsert = false;
        $categories = Danhmuc::where('status',Status::SHOW())->get();
        return view('admin.brand.brandDetail',compact('status','isInsert','categories','brand'));
    }

    public function updateBrand(Request $request, $id){
        $this->check();
        $data = $request->all();
        $brand = Brand::find($id);
        $brand->name = $data['name'];
        $brand->description = $data['description'];
        $brand->status = $data['status'];
        $brand->slug = SlugController::slugify($data['name']);
        $brand->category_id = $data['category'];
        $brand->save();
        return Redirect::to('brand/edit/'.$brand->id);
    }

    public function deleteBrand(Request $request){
        $this->check();
        $id = $request['id'];
        Brand::where('id',$id)->delete();
        return Redirect::to('brand');
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
