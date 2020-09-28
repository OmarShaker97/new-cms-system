<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Role;
use App\Permission;

class RoleController extends Controller
{
    //

    public function index(){
        return view('admin.roles.index',[
            'roles'=>Role::all()
        ]);
    }

    public function store(){

        request()->validate(['name'=>['required']]);

        Role::create([
        'name'=>Str::ucfirst(Str::lower(request('name'))),
        'slug'=>Str::of(Str::lower(request('name')))->slug('-')
        ]);
        
        return back();
    }

    

    public function update(Role $role){

        $role->name = Str::ucfirst(Str::lower(request('name')));
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');

        if($role->isClean('name')){
            session()->flash('role-updated-message', 'You haven\'t done any changes.');
        } else {
            session()->flash('role-updated-message', 'Role was updated!');
            $role->save();
        }

        return redirect()->route('roles.index');
    }



    public function destroy(Role $role){

        $role->delete();

        session()->flash('role-delete-message', 'Role was deleted');

        return back();

    }

    
    public function edit(Role $role){

        return view('admin.roles.edit', 
        ['role'=>$role,
        'permissions'=>Permission::all()]);

    }

    public function attach_permission(Role $role){

        $role->permissions()->attach(request('permission'));

        return back();

    }

    public function detach_permission(Role $role){

        $role->permissions()->detach(request('permission'));

        return back();
        
    }
}
