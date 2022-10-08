<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;

use App\Models\Module;
use App\Models\Role;

class RoleController extends Controller
{
    //All Roles
    public function index( Request $request )
    {
        
        // Gate::authorize('app.roles.index');
        $roles=Role::filter()->latest()->with('permissions')->paginate(10)->appends($request->query());
        // $roles = Role::with('permissions')->paginate(20);
        return Inertia::render('Backend/Role/Index',[
            'roles' => $roles,
            'queries'=>$request->all()?$request->all():['value'=>null],
        ]);
    }

    //Create Role
    public function create()
    {
        // Gate::authorize('app.role.create');
        $modules = Module::with('permissions')->get();
        return Inertia::render('Backend/Role/Create',[
            'modules' => $modules
        ]);
    }

    //Store Role
    public function store(Request $request)
    {
        // Gate::authorize('app.role.create');
        $request->validate([
            'name'=>'required|string|unique:roles',
        ]);

        Role::create([
            'name' => $request->name,
            'slug'=>Str::slug($request->name),
        ])->permissions()->sync($request->input('permissions', []));

        return Redirect::route('app.roles.index')->with('success','Role Created Successfully!');
    }

    //Edit Role Form
    public function edit($role)
    {
        // Gate::authorize('app.role.update');
        $role=Role::where('slug',$role)->with('permissions')->first();
        $modules = Module::with('permissions')->get();
        return Inertia::render('Backend/Role/Edit',[
            'role' => $role,
            'modules' => $modules
        ]);
    }

    //Update Role
    public function update(Request $request, Role $role)
    {
        // Gate::authorize('app.role.update');
        $role->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        $role->permissions()->sync($request->input('permissions'));
        return Redirect::route('app.roles.index')->with('success','Role Updated Successfully!');
    }

    //Delete Role
    public function destroy(Role $role)
    {
        // Gate::authorize('app.role.destroy');
        $role->delete();
        return back()->with('success','Role Deleted Successfully');
    }
}
