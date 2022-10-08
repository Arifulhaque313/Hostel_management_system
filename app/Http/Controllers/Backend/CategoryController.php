<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.categories.index');
        $categories = Category::paginate(10);
        return Inertia::render('Backend/Categories/Index',['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.category.create');
        return Inertia::render('Backend/Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.category.create');
        $request->validate([
            'name'=>'required|string',
            'thumbnail'=>'nullable|mimes:jpeg,jpg,png',
        ]);
 
        Category::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'image'=>$request->hasFile('thumbnail') ? $request->thumbnail->store('categories'): null,
        ]);
 
        return Redirect::route('app.categories')->with('success','Category Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        Gate::authorize('app.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        Gate::authorize('app.category.update');
        return Inertia::render('Backend/Categories/Edit',['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        Gate::authorize('app.category.update');
        $request->validate([
            'name'=>'string',
            'thumbnail'=>'nullable|mimes:jpeg,jpg,png'
        ]);
        if ($request->hasFile('thumbnail')){

            if (Storage::disk('public')->exists($category->getRawOriginal('image'))){
                Storage::disk('public')->delete($category->getRawOriginal('image'));
            }
        }
 
        $category->update([
            'name' => $request->name,
            'slug'=>Str::slug($request->name),
            'image'=>$request->hasFile('thumbnail') ? $request->file('thumbnail')->store('categories') : $category->getRawOriginal('image'),
        ]);
 
        return Redirect::route('app.categories')->with('success','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Gate::authorize('app.category.delete');
        if (Storage::disk('public')->exists($category->getRawOriginal('image'))){
            Storage::disk('public')->delete($category->getRawOriginal('image'));
        }
        $category->delete();
        return Redirect::back()->with('success','Category Deleted Successfully');
    }
}
