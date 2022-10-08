<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.blog-categories.index');
        $categories = BlogCategory::paginate(10);
        return Inertia::render('Backend/BlogCategories/Index',['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.blog-categories.create');
        return Inertia::render('Backend/BlogCategories/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.blog-categories.create');
        $request->validate([
            'name'=>'required|string'
        ]);
 
        BlogCategory::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
        ]);
 
        return Redirect::route('app.blog-categories.index')->with('success','Blog Category Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $category)
    {
        //Gate::authorize('app.blog-categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $blogCategory)
    {
        // dd($blogCategory);
        Gate::authorize('app.blog-categories.edit');
        return Inertia::render('Backend/BlogCategories/Edit',['category' => $blogCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
        Gate::authorize('app.blog-categories.edit');
        $request->validate([
            'name'=>'string',
        ]);
 
        $blogCategory->update([
            'name' => $request->name,
            'slug'=>Str::slug($request->name),
        ]);
 
        return Redirect::route('app.blog-categories.index')->with('success','Blog Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $blogCategory)
    {
        Gate::authorize('app.blog-categories.delete');
        $blogCategory->delete();
        return Redirect::back()->with('success','Blog Category Deleted Successfully');
    }
}
