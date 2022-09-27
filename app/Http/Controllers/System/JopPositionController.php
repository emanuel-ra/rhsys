<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\JopPosition;
use App\Models\AuthorizedPost;
use App\Models\branch;

class JopPositionController extends Controller
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
        $data= JopPosition::where('enable',1)->with('Department')->get();      
        return view('system.jop-position.app',['data'=>$data]);
    }   
    public function register(){   
        $Department = Department::where('enable','1')->get();
        return view('system.jop-position.register',['Department'=>$Department]);
    }   
    public function store(Request $request)
    {
        $this->validate($request, [               
            'name' => 'required|max:255|unique:jop_positions',                   
            'department_id' => 'required'
        ]); 
      
        $JopPosition = new JopPosition;

        $JopPosition->name = $request->name;
        $JopPosition->department_id = $request->department_id;

        $record = $JopPosition->save();
            
        $branch = branch::get();
        foreach($branch as $item)
        {
            $AuthorizedPost = new AuthorizedPost;
            $AuthorizedPost->company_id=$item->company_id;
            $AuthorizedPost->branch_id=$item->branch_id;

            $AuthorizedPost->department_id = $request->department_id;;
            $AuthorizedPost->jop_position_id = $record;
            $AuthorizedPost->quantity=0;
            $AuthorizedPost->save();
        }        
        return redirect()->route('system.jop.position.index');
    }
    public function edit($id){                   
        $data = JopPosition::find($id);
        $Department = Department::where('enable','1')->get();
        return view('system.jop-position.edit',['data'=>$data,'Department'=>$Department,'id'=>$id]);
    }
    public function update($id,Request $request)
    {
        $this->validate($request, [               
            'name' => 'required|max:255|unique:jop_positions,id,'.$id ,
            'department_id' => 'required'
        ]); 
        
        $data = JopPosition::find($id);
        $data->name = $request->name;
        $data->department_id = $request->department_id;
        $data->save();

        return redirect()->route('system.jop.position.index');

    }
}
