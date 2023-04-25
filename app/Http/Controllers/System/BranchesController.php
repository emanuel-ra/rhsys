<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Company;


class BranchesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission: branches.index|branches.create|branches.update|branches.delete']);
    }   
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Branch::where('enable','1')->with('company')->get();        
        return view('system.branches.app',['data'=>$data]);
    }   
    public function register(){

        $companies = Company::where('enable','1')->get();
       
        return view('system.branches.register',[
            'companies' => $companies
        ]);
    }   
    public function store(Request $request)
    {
        $this->validate($request, [               
            'name' => 'required|max:255|unique:branches',         
            'company_id' => 'required',
        ]); 
     
        $Branch = new Branch;

        $Branch->name = $request->name;
        $Branch->company_id = $request->company_id;
        $Branch->address = $request->address;
        $Branch->zip_code = $request->zip_code;

        $Branch->save();

        return redirect()->route('system.branches');

    }
    public function edit($id){
        
        $data = Branch::find($id);
        $companies = Company::where('enable',1)->get();
        
        return view('system.branches.edit',['companies'=>$companies,'data'=>$data,'id'=>$id]);
    }
    public function update($id,Request $request)
    {
        $this->validate($request, [               
            'name' => 'required|max:255|unique:branches,id,'.$id,         
        ]);

        $data = Branch::find($id);

        $data->name = $request->name;
        $data->company_id = $request->company_id;
        $data->address = $request->address;
        $data->zip_code = $request->zip_code;

        $data->save();

        return redirect()->route('system.branches');

    }

    // AJAX
    public function getJson(Request $request){
        $data = Branch::where('company_id',$request->company_id)->get(); 

        return Response()->json($data,200);
    }
}
