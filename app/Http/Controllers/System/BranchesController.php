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
            'name' => 'required|max:255|unique:companies',         
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
        
        $company = Company::find($id);
        
        return view('system.branches.edit',['company'=>$company,'id'=>$id]);
    }
    public function update($id,Request $request)
    {
        $this->validate($request, [               
            'name' => 'required|max:255|unique:companies,id,'.$id,         
        ]);

        $company = Company::find($id);

        $company->name = $request->name;
        $company->business_name = $request->business_name;
        $company->address = $request->address;
        $company->zip_code = $request->zip_code;

        $company->save();

        return redirect()->route('system.branches');

    }
}
