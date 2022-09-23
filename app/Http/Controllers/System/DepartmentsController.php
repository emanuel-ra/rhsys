<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentsController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission: jop.position.index|jop.position.create|jop.position.update|jop.position.delete']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data= Department::where('enable',1)->get();      
        return view('system.departments.app',['data'=>$data]);
    }   
    public function register(){        
        return view('system.departments.register');
    }   
    public function store(Request $request)
    {
        $this->validate($request, [               
            'name' => 'required|max:255|unique:departments',                   
        ]); 
      
        $data = new Department;

        $data->name = $request->name;

        $data->save();
       
        return redirect()->route('system.departments');
    }
    public function edit($id){                   
        $data = Department::find($id);
        return view('system.departments.edit',['data'=>$data,'id'=>$id]);
    }
    public function update($id,Request $request)
    {
        $this->validate($request, [               
            'name' => 'required|max:255|unique:departments,id,'.$id ,
        ]); 
        
        $data = Department::find($id);
        $data->name = $request->name;
        $data->save();

        return redirect()->route('system.departments');

    }
}
