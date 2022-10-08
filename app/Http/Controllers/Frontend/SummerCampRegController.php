<?php

namespace App\Http\Controllers\Frontend;

use App\Models\SummerCampReg;
use App\Http\Controllers\Controller;
use App\Models\RegRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;
use Illuminate\Support\Str;


class SummerCampRegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'student_name'=>'required|string',
            'age'=>'required|integer',
            'grade'=>'required',
            'guardian_name'=>'required|string',
            'home_address'=>'required|string',
            'work'=>'required|string',
            'zip'=>'required|integer|',
            'email'=>'required|email',
            'about'=>'required|string',
            'emergency_contact'=>'required|string',
             
         ]);

       $sumCampReg = SummerCampReg::create([
                'name' => $request->student_name,
                'age' => $request->age,
                'slug'=>Str::slug($request->name),
                'grade' => $request->grade,
                'guardian_name' => $request->guardian_name,
                'home_address' => $request->home_address,
                'work' => $request->work,
                'zipcode' => $request->zip,
                'email' => $request->email,
                'emergency_contact' => $request->emergency_contact,
                'about' => $request->about,
                'student_type' => $request->new_student,
                'camp_hours' => $request->new_student ? json_encode($request->camp_hour):null,
                'weekly_class_hours' => $request->new_student ? json_encode($request->weeklyHour):null,

        ]);

        $sumCampReg = SummerCampReg::find($sumCampReg->id);
        // dd($sumCampReg);
        return Inertia::render('Frontend/SummerRegistration/_id/show',['sumCampReg' => $sumCampReg]);

        // return back()->with('success','Registration Successful');
        //   return redirect()->route('summercamp.print',['id' => Crypt::encryptString($SummerCampReg->id)])->with('success','Registration Successful');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SummerCampReg  $summerCampReg
     * @return \Illuminate\Http\Response
     */
    public function show(SummerCampReg $summerCampReg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SummerCampReg  $summerCampReg
     * @return \Illuminate\Http\Response
     */
    public function edit(SummerCampReg $summerCampReg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SummerCampReg  $summerCampReg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SummerCampReg $summerCampReg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SummerCampReg  $summerCampReg
     * @return \Illuminate\Http\Response
     */
    public function destroy(SummerCampReg $summerCampReg)
    {
        //
    }
}
