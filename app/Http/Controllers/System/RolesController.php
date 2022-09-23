<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission: roles.index|roles.create|roles.update|roles.delete']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Role::get();        
        return view('system.roles.app',['data'=>$data]);
    }   
    public function register(){
       
        $Permissions = Permission::get();
        return view('system.roles.register',['permissions'=>$Permissions]);
    }   
    public function store(Request $request)
    {
        $this->validate($request, [               
            'name' => 'required|max:255|unique:roles',         
            'permission_id' => 'required|min:1',
        ]); 
      
        $role = Role::create(['name' => $request->name])->syncPermissions($request->permission_id);
        
        return redirect()->route('system.roles');
        

    }
    public function edit($id){             

        $role = Role::where('id',$id)->with('permissions')->get();        
        $Permissions = Permission::get();
        return view('system.roles.edit',['role'=>$role,'permissions'=>$Permissions,'id'=>$id]);
    }
    public function update($id,Request $request)
    {
        $this->validate($request, [               
            'name' => 'required|max:255|unique:roles,id,'.$id,         
            'permission_id' => 'required|min:1',
        ]);

        $Role = Role::find($id);
        $Role->name = $request->name;

        $Role->syncPermissions($request->permission_id);
        
      
        $Role->save();
        return redirect()->route('system.roles');

    }
}
