<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request){
        $products = Product::filter()->with('category','subcategory','images','variantProperties')->paginate(12);
        $categories = Category::get();
        if($request->wantsJson()){
            return $products;
        }
        return Inertia::render('Frontend/shop/index',['products'=>$products,'categories'=>$categories,'queries'=>$request->all()?$request->all():['value'=>null]]);
    }


     public function show($slug){
        $product = Product::where('slug',$slug)->with('category','subcategory','images','variantProperties','variantProperties.variant')->first();
        return Inertia::render('Frontend/shop/_slug/index',['product'=>$product]);
    }
}
