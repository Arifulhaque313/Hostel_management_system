<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class ContactController extends Controller
{
    public function store(Request $request){
        // dd($request->all());
         $request->validate([
            'name'=>'required|string',
            'email'=>'required|string',
            'location'=>'required',
            'subject' => 'required',
            'message' => 'required',
         ]);

        $contact =Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'location' => $request->location,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

          if($contact){
            return Redirect::route('contact')->with('success', 'Contact added Successfully');
        }else{
            return Redirect::route('contact')->with('error', 'Contact added Failed');
        }
    }
}
