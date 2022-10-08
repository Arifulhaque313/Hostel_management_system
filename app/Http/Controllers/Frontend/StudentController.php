<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'school_name' => 'required',
            'class' => 'required',
            'mobile' => 'required|unique:student',
            'email' => 'required|unique:student',
            'password' => 'required|confirmed',
            'address' => 'required',
            'country' => 'required',
            'image' => 'required',
            'status' => 'required',
        ]);

        $student = Student::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'school_name' => $request->school_name,
            'class' => $request->class,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => $request->password,
            'address' => $request->address,
            'country' => $request->country,
            'image' => $request->image,
            'status' => $request->status
        ]);

        if( $student ){
            $with = with('success','Student Registration Successfully!');
        }else{
            $with = with('error','Student Registration Failed!');
        }

        return redirect()->route('#')->$with;


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
