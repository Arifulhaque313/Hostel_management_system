<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $hostels = Hostel::get();
        return Inertia::render('Backend/Hostel/Index',['hostels' => $hostels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Backend/Hostel/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title'=>'required|string',
            'owner'=>'required|string',
            'type'=>'required',
            'owner_num'=>'required|numeric|digits:11',
            'area'=>'required|string',
            'address'=>'required|string',
            'rent'=>'required|numeric',
            'description'=>'string',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,gif',
         ]);

        $image=$request->file('thumbnail');
        if (isset($image)){
            $imgName=Str::slug($request->owner).uniqid().'.'.$image->getClientOriginalExtension();
        }

        $Hostel=Hostel::create([
            'title' => $request->title,
            'owner' => $request->owner,
            'owner_num' => $request->owner_num,
            'type' => $request->type,
            'person' => $request->person,
            'area' => $request->area,
            'address' => $request->address,
            'rent' => $request->rent,
            'description' => $request->description,
            'slug'=>Str::slug($request->owner),
            'thumbnail'=>$request->file('thumbnail')->storeAs('hostel',$imgName),
        ]);

        return Redirect::route('app.hostels.index')->with('success', 'To-Let Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function show(Hostel $hostel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hostel $hostel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hostel $hostel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Hostel $hostel)
    {
        if (Storage::disk('public')->exists($hostel->getRawOriginal('thumbnail'))){
            Storage::disk('public')->delete($hostel->getRawOriginal('thumbnail'));
        }
        $hostel->delete();
        return back()->with("danger", "TO-Let Deleted");
    }
}
