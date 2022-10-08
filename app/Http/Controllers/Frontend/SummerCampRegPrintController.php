<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SummerCampReg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;

class SummerCampRegPrintController extends Controller
{
    public function show($id){
        $id = (Crypt::decryptString($id));
        $sumCampReg = SummerCampReg::find($id);
        
        return Inertia::render('Frontend/SummerRegistration/_id/show',['sumCampReg' => $sumCampReg]);

    }

    // public function show($id)
    // {   
    //     $sumCampReg = SummerCampReg::find($id);
        
    //     return Inertia::render('Backend/SumCampReg/show',['sumCampReg' => $sumCampReg]);
    // }
}
