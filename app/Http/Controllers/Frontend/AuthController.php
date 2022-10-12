<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\RegRequest;
use App\Models\User;
// use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class AuthController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required|numeric|digits:11|regex:/(01)[0-9]{9}/',
            'password' => 'min:6|confirmed',
            'terms'=>['required',Rule::in([true])],
         ]);

       $user = User::create([
            'name' => $request->name,
            'role_id' => 2,
            'slug'=>Str::slug($request->name),
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        Auth::login($user);
        $hostels = Hostel::get();
        return Inertia::render('Frontend/Home',[
            'hostels' => $hostels
        ]);
    }
}
