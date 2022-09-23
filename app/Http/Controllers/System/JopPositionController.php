<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JopPosition;

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
        $data= JopPosition::where('enable',1)->get();      
        return view('system.jop-position.app',['data'=>$data]);
    }   
    public function register(){        
        return view('system.jop-position.register');
    }   
    public function store(Request $request)
    {
        $this->validate($request, [               
            'name' => 'required|max:255|unique:jop_positions',                   
        ]); 
      
        $JopPosition = new JopPosition;

        $JopPosition->name = $request->name;

        $JopPosition->save();
       
        return redirect()->route('system.jop.position.index');
    }
    public function edit($id){                   
        $data = JopPosition::find($id);
        return view('system.jop-position.edit',['data'=>$data,'id'=>$id]);
    }
    public function update($id,Request $request)
    {
        $this->validate($request, [               
            'name' => 'required|max:255|unique:jop_positions,id,'.$id ,
        ]); 
        
        $data = JopPosition::find($id);
        $data->name = $request->name;
        $data->save();

        return redirect()->route('system.jop.position.index');

    }
}
