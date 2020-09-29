<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Permission;


class PermissionController extends Controller
{
    //

    public function index(){
        return view('admin.permissions.index',[
            'permissions' => Permission::all()
        ]);
    }

    public function store(){
        request()->validate(['name'=>['required']]);

        Permission::create([
        'name'=>Str::ucfirst(Str::lower(request('name'))),
        'slug'=>Str::of(Str::lower(request('name')))->slug('-')
        ]);
        
        return back();
    }

    public function edit(Permission $permission){

        return view('admin.permissions.edit', ['permission'=>$permission]);

    }

    public function destroy(Permission $permission){
   
        $permission->delete();

        session()->flash('permission-delete-message', 'Permission was deleted');

        return back();

    }

    public function update(Permission $permission){

        $permission->name = Str::ucfirst(Str::lower(request('name')));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');

        if($permission->isClean('name')){
            session()->flash('permission-updated-message', 'You haven\'t done any changes.');
        } else {
            session()->flash('permission-updated-message', 'Permission was updated!');
            $permission->save();
        }

        return redirect()->route('permissions.index');
    }

}
