<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompaniesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission: companies.index|companies.create|companies.update|companies.delete']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companies = Company::where('enable','1')->get();
        return view('system.companies.app',['companies'=>$companies]);
    }   
    public function register(){       
        return view('system.companies.register');
    }   
    public function store(Request $request)
    {
        $this->validate($request, [               
            'name' => 'required|max:255|unique:companies',         
        ]); 

        $Company = new Company;

        $Company->name = $request->name;
        $Company->business_name = $request->business_name;
        $Company->address = $request->address;
        $Company->zip_code = $request->zip_code;

        $Company->save();

        return redirect()->route('system.companies');

    }
    public function edit($id){
        
        $company = Company::find($id);
        
        return view('system.companies.edit',['company'=>$company,'id'=>$id]);
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

        return redirect()->route('system.companies');

    }
}
