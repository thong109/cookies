<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    public function blogs()
    {
        $blogs = Blog::leftJoin('tbl_admin', 'tbl_admin.admin_id', '=', 'blogs.created_by')
            ->select('blogs.*', 'tbl_admin.admin_name as author')->get();
        return view('admin.blog.blogs', compact('blogs'));
    }

    public function createBlogs()
    {
        $isInsert = true;
        return view('admin.blog.blogDetail', compact('isInsert'));
    }

    public function insertBlogs(Request $request)
    {
        $blog = new Blog();
        $blog->name = $request->name;
        $blog->slug = SlugController::slugify($request->name);
        $blog->content = $request->content;
        $files = $request->file('image');
        if ($files != "") {
            $fileImage = $files->getClientOriginalName();
            $nameImage = str_replace([' ', '-'], '_', current(explode('.', $fileImage)));
            $newImage = $nameImage . '-' . rand(0, 99) . '.' . $files->getClientOriginalExtension();
            $image = '/camera/public/imgs/blog/' . $newImage;
            $files->move(public_path('imgs/blog'), $newImage);
        }
        $blog->image = $image;
        $blog->created_by = Session::get('admin_id');
        $blog->save();

        return redirect()->route('Blogs');
    }

    public function editBlogs($id)
    {
        $isInsert = false;
        $blog = Blog::where('id', $id)->first();
        if ($blog) {
            return view('admin.blog.blogDetail', compact('isInsert', 'blog'));
        }
        echo 'Không có bài viết';
    }

    public function saveBlogs(Request $request, $id)
    {
        $blog = Blog::where('id', $id)->first();
        if ($blog) {
            $blog->name = $request->name;
            $blog->slug = SlugController::slugify($request->name);
            $blog->content = $request->content;
            $files = $request->file('image');
            if ($files != "") {
                $fileImage = $files->getClientOriginalName();
                $nameImage = str_replace([' ', '-'], '_', current(explode('.', $fileImage)));
                $newImage = $nameImage . '-' . rand(0, 99) . '.' . $files->getClientOriginalExtension();
                $image = '/camera/public/imgs/blog/' . $newImage;
                $files->move(public_path('imgs/blog'), $newImage);
                $blog->image = $image;
            }
            $blog->created_by = Session::get('admin_id');
            $blog->save();
            return redirect()->route('Blogs');
        }
        echo 'Không có bài viết';
    }

    public function deleteBlog(Request $request)
    {
        $id = $request->id;
        Blog::where('id', $id)->delete();
        return redirect()->route('Blogs');
    }

    public function detailBlog($id)
    {
        $blog = Blog::leftJoin('tbl_admin', 'tbl_admin.admin_id', '=', 'blogs.created_by')
            ->select('blogs.*', 'tbl_admin.admin_name as author')->where('blogs.id', $id)->first();
        return view('home.inc.blogDetail', compact('blog'));
    }
}
