<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\newsletter;
use BadFunctionCallException;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {       
        $request->validate([
            'email'=>'required|email',
         ]);
        $newsletter = newsletter::create([
            'email' => $request->email
        ]);
        return back()->with('success','Subscribe Successfull');
    }
}
