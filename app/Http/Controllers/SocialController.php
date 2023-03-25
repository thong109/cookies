<?php

namespace App\Http\Controllers;

use App\Models\CommentPost;
use App\Models\Customer;
use App\Models\MXH;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;

class SocialController extends Controller
{
    public function PetMXH(){
        $social = MXH::all();
        $customer = Customer::where('customer_id',Session::get('customer_id'))->first();
        $postColumn = Post::where('category_mxh_id',22)->get();
        $postColumns = Post::where('category_mxh_id',21)->get();
        $commentPost = CommentPost::all();
        return view('mxh.social',compact('social','customer','postColumn','commentPost','postColumns'));
    }
    public function ProfileCustomer($customer_id){
        $customer = Customer::where('customer_id',$customer_id)->first();
        $cateMxh = MXH::orderBy('category_mxh_id', 'asc')->get();
        $postUser = Post::where('customer_id',Session::get('customer_id'))->get();
        if($customer){
            return view('mxh.profile',compact('customer','cateMxh','postUser'));
        }else{
            return view('mxh.login')->with('message','Bạn phải đăng nhập mới được xem thông tin');
        }
    }
    public function addPost(Request $request){
        $post = new Post();
        $post->customer_id = Session::get('customer_id');
        $post->category_mxh_id = $request->post_desc_mxh;
        $post->post_desc = $request->post_desc;
        $post->post_content = $request->post_content;
        $get_image = $request->file('post_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post',$new_image);
            $post->post_image = $new_image;
        }else{
            $post->post_image = 'default.jpg';
        }
        $post = $post->save();
        return redirect()->back()->with('message','Thêm thành công');
        // $cateMxh = MXH::orderBy('category_mxh_id', 'asc')->get();
        // return view('mxh.add_post',compact('cateMxh'));
    }
    public function delPost($post_id){
        Post::where('post_id', $post_id)->delete();
        return redirect()->back()->with('message','Xóa thành công');
    }
    public function inFor($post_id){
        $social = MXH::all();
        $inForPost = Post::where('post_id',$post_id)->first();
        $relatedNews = Post::where('category_mxh_id', $inForPost->category_mxh_id)->whereNotIn('post_id', [$post_id])->limit(6)
        ->get();
        $commentPost = CommentPost::where('comment_post_id',$post_id)->get();
        return view('mxh.infor',compact('inForPost','social','relatedNews','commentPost'));
    }
    public function addComment(Request $request){
        $addComment = new CommentPost();
        $addComment->comment_name = $request->comment_name;
        $addComment->comment_post_id = $request->comment_post_id;
        $addComment->comment = $request->comment;
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $addComment->comment_date = $now;
        $addComment->save();
        return redirect()->back()->with('message','Thêm thành công');
    }
    public function likePost($post_id){
        $checkPost = Post::find($post_id);
        $checkPost->post_like_active = 1;
        $checkPost->post_like =  $checkPost->post_like +1;
        $checkPost->save();
        return redirect()->back();
    }
}
