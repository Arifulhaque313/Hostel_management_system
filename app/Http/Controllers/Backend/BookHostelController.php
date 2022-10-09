<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BookHostel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookHostelController extends Controller
{
    public function index(){
        
        $bookHostels = BookHostel::with('user','hostel')->get();
        return Inertia::render('Backend/Bookings/Index',['bookHostels'=>$bookHostels]);
    }
}
