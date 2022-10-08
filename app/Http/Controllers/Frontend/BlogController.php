<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;


class BlogController extends Controller
{
   public function index(){
     $category_id = request()->category_id ?? null;
     $blogs = Blog::with('category','images','user');
     if($category_id){
          $blogs->where('category_id', $category_id);
     }
        $blogs = $blogs->paginate(5);
        $recent_posts = Blog::latest()->paginate(4);
        $blog_categories = BlogCategory::with('blogs')->get();
        return Inertia::render('Frontend/Blog', ['blogs' => $blogs , 'recent_posts' => $recent_posts, 'blog_categories' => $blog_categories]);
   }


   public function show($slug){
        $blog = Blog::where('slug',$slug)->with('category','images','user')->first();
        return Inertia::render('Frontend/BlogDetails', ['blog' => $blog] );
      
   }
}
