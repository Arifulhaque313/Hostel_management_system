<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use App\Actions\Helpers\MultiImages;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        Gate::authorize('app.subcategories.index');
        $category=Category::findOrFail($id);
        return Inertia::render('Backend/SubCategories/Index', [
            'subcategories' => $category->subcategories()->latest()->paginate(10),
            'category' => $category,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        Gate::authorize('app.subcategory.create');
        $category=Category::findOrFail($id);
        return Inertia::render('Backend/SubCategories/Create', [
            'category' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.subcategory.create');
        $request->validate([
            'name'=>'required|string',
            'thumbnail'=>'nullable|mimes:jpeg,jpg,png',
        ]);

        $subcategory=SubCategory::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'image'=>$request->hasFile('thumbnail') ? $request->thumbnail->store('subcategories'): null,
            'category_id'=>$request->category_id
        ]);

        $multi=new MultiImages($request,$subcategory);
        $multi->store();

        $category=Category::where('id',$request->category_id)->first();

        return redirect()->route('app.subcategories', $category->id)->with('success','SubCategory Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subcategory)
    {
        Gate::authorize('app.subcategories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category,$subcategory)
    {
        Gate::authorize('app.subcategory.update');
        $subcategory=SubCategory::where('id',$subcategory)->first();
        return Inertia::render('Backend/SubCategories/Edit',['category'=>$category,'subcategory' => $subcategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,SubCategory $subcategory)
    {
        Gate::authorize('app.subcategory.update');
        $request->validate([
            'name'=>'required|string',
            'thumbnail'=>'nullable|mimes:jpeg,jpg,png'
        ]);

        if ($request->hasFile('thumbnail')){

            if (Storage::disk('public')->exists($subcategory->getRawOriginal('image'))){
                Storage::disk('public')->delete($subcategory->getRawOriginal('image'));
            }
        }

        $subcategory->update([
            'name' => $request->name,
            'slug'=>Str::slug($request->name),
            'image'=>$request->hasFile('thumbnail') ? $request->file('thumbnail')->store('subcategories') : $subcategory->getRawOriginal('image'),
            'category_id' => $request->category_id
        ]);

        $multi=new MultiImages($request,$subcategory);
        $multi->update();

        $category=Category::where('id',$request->category_id)->first();

        return redirect()->route('app.subcategories', $category->id)->with('success','SubCategory Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subcategory)
    {
        Gate::authorize('app.subcategory.delete');
        if (Storage::disk('public')->exists($subcategory->getRawOriginal('image'))){
            Storage::disk('public')->delete($subcategory->getRawOriginal('image'));
        }
        $subcategory->delete();
        return back()->with('success','Sub Category Deleted Successfully');
    }
}
