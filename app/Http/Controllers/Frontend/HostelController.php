<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HostelController extends Controller
{
    
    public function index(){
        $hostels = Hostel::get();
        return Inertia::render('Frontend/Hostel',['hostels'=>$hostels]);
    }


    public function show($id){
        $hostel = Hostel::find($id);
        return Inertia::render('Frontend/HostelDetails',['hostel'=>$hostel]);
    }


    public function search(Request $request){
        $request->validate([
            'area' =>'required',
            'rent_form' =>'required',
            'rent_to' =>'required',
            'type' =>'required',
        ]);
        $hostel = Hostel::where('area','LIKE','%'.$request->area.'%')
        ->where('rent', '>=',$request->rent_form)
        ->where('rent', '<=',$request->rent_to)
        ->where('type','LIKE','%'.$request->type.'%')
        
        ->get();
        return Inertia::render('Frontend/Hostel',['hostels'=>$hostel]);
    }
}
