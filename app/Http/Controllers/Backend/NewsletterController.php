<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\newsletter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsletters = newsletter::paginate(10);
        return Inertia::render('Backend/Newsletter/Index',['newsletters'=>$newsletters]);

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
   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        newsletter::find($id) -> delete();
        return back()->with('success', 'Succesfully Deleted');
               
    }
}
