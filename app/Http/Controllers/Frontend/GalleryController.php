<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\GalleryCategory;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index(){

        $galleryCategorys = GalleryCategory::with('gallery')->get();

        return Inertia::render('Frontend/Gallery',['galleryCategorys' => $galleryCategorys]);
    }

    public function category( $id ){
        $galleryCategory = GalleryCategory::where('id', $id)->with('gallery')->get();
        return Inertia::render('Frontend/SubGallery',['galleryCategory' => $galleryCategory, 'allGalleryCategory' => GalleryCategory::all() ]);
    }
}
