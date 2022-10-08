<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;


use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    // All User
    public function index(Request $request)
    {
        // Gate::authorize('app.users.index');
        // $users = User::with('role')->paginate(20);
        $users=User::filter()->latest()->with('role')->paginate(10)->appends($request->query());
        $roles = Role::all();
        return Inertia::render('Backend/User/Index',[
            'users' => $users,
            'roles' => $roles,
            'queries'=>$request->all()?$request->all():['value'=>null],
        ]);
    }

    //Create User
    public function create()
    {
        // Gate::authorize('app.user.create');
        $roles = Role::get();
        return Inertia::render('Backend/User/Create',[
            'roles' => $roles
        ]);
    }


    //Store User
    public function store(Request $request)
    {
        dd($request->all());
        // Gate::authorize('app.user.create');
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required|string|max:11|regex:/(01)[0-9]{9}/',
            'password' => 'min:6|confirmed',
            'role_id'=>'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif'
         ]);

        $image=$request->file('image');

         if (isset($image)){
            $imgName=Str::slug($request->name).uniqid().'.'.$image->getClientOriginalExtension();
         }
        
         User::create([
            'name' => $request->name,
            'role_id' => $request->role_id,
            'slug'=>Str::slug($request->name),
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->filled('status'),
            'image'=>isset($request->image) ? $request->file('image')->storeAs('users',$imgName):null
        ]);
        return Redirect::route('app.users.index')->with('success', 'User Created Successfully!');
    }

    //Show Single User
    public function show($user)
    {
        // Gate::authorize('app.users.index');
        $user=User::where('slug', $user)->with('role')->first();
        return Inertia::render('Backend/User/Show',[
            'user' => $user
        ]);
    }

    //Edit User Form
    public function edit(User $user)
    {
        // Gate::authorize('app.user.update');
        $roles = Role::all();
        return Inertia::render('Backend/User/Edit',[
            'user' => $user,
            'roles' => $roles
        ]);
    }


    //Update User
    public function update(Request $request, User $user)
    {
        // Gate::authorize('app.users.update');
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required|string|max:11|regex:/(01)[0-9]{9}/',
            'password' => 'nullable|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif'
         ]);

        $image=$request->file('image');

        if (isset($image)){
            $imgName=Str::slug($request->name).uniqid().'.'.$image->getClientOriginalExtension();

            if (Storage::disk('public')->exists($user->getRawOriginal('image'))){
                Storage::disk('public')->delete($user->getRawOriginal('image'));
            }
        }
        $user->update([
            'name'=>$request->name,
            'role_id' => $request->role_id,
            'slug'=>Str::slug($request->name),
            'phone'=>$request->phone,
            'email'=>$request->email,
            'password' => isset($request->password) ? Hash::make($request->password) : $user->password,
            'status' =>  isset($request->status) ? $request->status : $user->status,
            'image'=> isset($request->image) ? $request->file('image')->storeAs('users',$imgName) : $user->getRawOriginal('image'),
        ]);

        return Redirect::route('app.users.index')->with('success','User Updated Successfully!');
    }

    //Delete User
    public function destroy(User $user)
    {
        // Gate::authorize('app.user.destroy');
        if (Storage::disk('public')->exists($user->getRawOriginal('image'))){
            Storage::disk('public')->delete($user->getRawOriginal('image'));
        }

        $user->delete();
        return back()->with("success", "User Deleted Successfully!");
    }
}
