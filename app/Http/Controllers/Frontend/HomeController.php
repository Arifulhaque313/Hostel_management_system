<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(){
        $hostels = Hostel::get();
        return Inertia::render('Frontend/Home',['hostels' => $hostels]);
    }
}
