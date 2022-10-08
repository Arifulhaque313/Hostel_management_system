<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;
class ProfileController extends Controller
{
    public function index($user)
    {
        // Gate::authorize('app.user.profile');
        $user=User::where('id', $user)->with('role')->first();
        return Inertia::render('Backend/User/Profile',[
            'user' => $user
        ]);
    }


    public function update(Request $request, User $user)
    {   
        // dd($request->all());
        // Gate::authorize('app.user.profile.update');
        $request->validate([
            'name'=>'nullable|string',
            'email'=>'nullable|regex:/(.+)@(.+)\.(.+)/i',
            'phone'=>'nullable|string',
            'image'=>'nullable|mimes:jpg,png,jpeg,gif',
            'password'=>'nullable|min:6|confirmed',
         ]);
 
        $image = $request->file('image');
        if (isset($image)) {
            $imgName = Str::slug($request->name) . uniqid() . '.' . $image->getClientOriginalExtension();
            if (Storage::disk('public')->exists($user->getRawOriginal('image'))) {
                Storage::disk('public')->delete($user->getRawOriginal('image'));
            }
        }
         
        $user->update([
            'name' => isset($request->name) ? $request->name : $user->name,
            'email' => isset($request->email) ? $request->email : $user->email,
            'phone' => isset($request->phone) ? $request->phone : $user->phone,
            'password' => isset($request->password) ? Hash::make($request->password) : $user->password,
            'image' => isset($request->image) ? $image->storeAs('users', $imgName) : $user->getRawOriginal('image'),
            
        ]);
 
        return Redirect::route('app.dashboard')->with('success','User Profile updated');
    }

}
