<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Actions\Helpers\MultiImages;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;


class BlogController extends Controller
{
    public function index()
    {
        Gate::authorize('app.blogs.index');
        $blogs = Blog::with('category')->paginate(10);
        return Inertia::render('Backend/Blog/Index', [
            'blogs' => $blogs,
        ]);
    }


    public function create()
    {
        Gate::authorize('app.blog.create');
        $categories=BlogCategory::get();
        return Inertia::render('Backend/Blog/Create',
    [
        'categories'=>$categories
    ]);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        Gate::authorize('app.blog.create');
        $request->validate([
            'title'=>'required|string',
            'author'=>'required|string',
            'description_field_one'=>'required|string',
            'description_field_two'=>'required|string',
            'description_field_three'=>'nullable|string',
            'description_field_four'=>'nullable|string',
            'category_id'=>'required|numeric',
            'link'=>'nullable|string',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,gif',
            'images'=>'required',
         ]);

        $image=$request->file('thumbnail');
        if (isset($image)){
            $imgName=Str::slug($request->title).uniqid().'.'.$image->getClientOriginalExtension();
        }

        $blog=Blog::create([
            'title' => $request->title,
            'author' => $request->author,
            'slug'=>Str::slug($request->title),
            'user_id' => Auth::user()->id,
            'description_field_one' => $request->description_field_one,
            'description_field_two' => $request->description_field_two,
            'description_field_three' => $request->description_field_three,
            'description_field_four' => $request->description_field_four,
            'category_id' => $request->category_id,
            'link'=> $request->link,
            'thumbnail'=>$request->file('thumbnail')->storeAs('blogs',$imgName),
        ]);
        $multi=new MultiImages($request,$blog);
        $multi->store();

        return Redirect::route('app.blogs.index')->with('success', 'Blog Post Created Successfully');
    }

    public function edit(Blog $blog)
    {
        Gate::authorize('app.blog.edit');
        $blog=Blog::where('id',$blog->id)->with('category','images')->first();
        $categories=BlogCategory::get();
        return Inertia::render('Backend/Blog/Edit',[
            'blog' => $blog,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $blog)
    {
        Gate::authorize('app.blog.edit');

        $blog = Blog::where('id', $blog)->first();
        $request->validate([
            'title'=>'required|string',
            'description_field_one'=>'required|string',
            'description_field_two'=>'required|string',
            'description_field_three'=>'nullable|string',
            'description_field_four'=>'nullable|string',
            'link'=>'nullable|string',
            'category_id'=>'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif',
         ]);

         $image=$request->file('thumbnail');
         if (isset($image)){
             $imgName=Str::slug($request->title).uniqid().'.'.$image->getClientOriginalExtension();
 
             if (Storage::disk('public')->exists($blog->getRawOriginal('thumbnail'))){
                 Storage::disk('public')->delete($blog->getRawOriginal('thumbnail'));
             }
         }

         $blog->update([
            'title' => $request->title,
            'slug'=>Str::slug($request->title),
            'description_field_one' => $request->description_field_one,
            'description_field_two' => $request->description_field_two,
            'description_field_three' => $request->description_field_three,
            'description_field_four' => $request->description_field_four,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'link'=> $request->link,
            'thumbnail'=>isset($image) ? $request->file('thumbnail')->storeAs('blogs',$imgName) : $blog->getRawOriginal('thumbnail'),
        ]);
        $multi=new MultiImages($request,$blog);
        $multi->update();
        

        return Redirect::route('app.blogs.index')->with('success', 'Blog Updated Successfully');
    }

    public function destroy(Request $request,Blog $blog)
    {
        Gate::authorize('app.blog.destroy');
        if (Storage::disk('public')->exists($blog->getRawOriginal('thumbnail'))){
            Storage::disk('public')->delete($blog->getRawOriginal('thumbnail'));
        }
        $blog->delete();
        return back()->with("danger", "Blog Deleted");
    }
}
