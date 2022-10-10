<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BookHostel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class BookHostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd("Its working");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $hostel_id = $id;
        return Inertia::render('Frontend/BookHostel/create',['hostel_id'=>$hostel_id]);
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
            'address'=>'required|string',
            'mobile'=>'required|numeric',
            'qualification'=>'required',
            'advance'=>'required|numeric',
            'trx_id'=>'required|string',
            'hostel_id'=>'required|numeric',
            'description'=>'string',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,gif',
         ]);

         $image=$request->file('thumbnail');
        if (isset($image)){
            $imgName=Str::slug($request->title).uniqid().'.'.$image->getClientOriginalExtension();
        }

         $book = BookHostel::create([
            'user_id' => Auth::user()->id,
            'address' => $request->address,
            'slug'=>Str::slug($request->address),
            'mobile' => $request->mobile,
            'advance' => $request->advance,
            'qualification' => $request->qualification,
            'trx_id' => $request->trx_id,
            'hostel_id' => $request->hostel_id,
            'description' => $request->description,
            'thumbnail'=>$request->file('thumbnail')->storeAs('bookHostel',$imgName),

         ]);
        return Redirect::route('dashboard')->with('success', 'Hostel Book successfully send');

    }

    public function mybookings(){
        $id = Auth::user()->id;
        $my_bookings = BookHostel::where('user_id','=',$id)->with('user','hostel')->get();
        return Inertia::render('Frontend/MyBooking',['my_bookings'=>$my_bookings]);
    }

    public function booking_cancel($id){
        $hostel = BookHostel::find($id);
        $hostel->update([
            'status' => 2
        ]);

       
        return Redirect::route('my.booking')->with('success', 'Hostel Book Cancel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookHostel  $bookHostel
     * @return \Illuminate\Http\Response
     */
    public function show(BookHostel $bookHostel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookHostel  $bookHostel
     * @return \Illuminate\Http\Response
     */
    public function edit(BookHostel $bookHostel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookHostel  $bookHostel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookHostel $bookHostel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookHostel  $bookHostel
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookHostel $bookHostel)
    {
        //
    }
}
