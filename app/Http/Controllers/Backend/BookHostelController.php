<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BookHostel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BookHostelController extends Controller
{
    public function index(){
        
        $bookHostels = BookHostel::with('user','hostel')->get();
        return Inertia::render('Backend/Bookings/Index',['bookHostels'=>$bookHostels]);
    }

    public function show($bookHostel){
        $hostel = BookHostel::with('user','hostel')->find($bookHostel);
        return Inertia::render('Backend/Bookings/Show',['hostel'=>$hostel]);
    }

    public function booking_cancel($id){
        $hostel = BookHostel::find($id);
        $hostel->update([
            'status' => 2
        ]);
        return Redirect::route('app.bookings.index')->with('success', 'Hostel Book Cancel');
    }

    public function booking_approved($id){
        $hostel = BookHostel::find($id);
        $hostel->update([
            'status' => 1
        ]);
        return Redirect::route('app.bookings.index')->with('success', 'Hostel Book Approved');
    }
}
