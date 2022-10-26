<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use File;

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
        $this->middleware(['permission: companies.index|companies.create|companies.update|companies.delete|system.companies.upload.logo']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $query = Company::query();

        $query = $query->where('enable',1);

        if(isset($request->searchKeyword)){
            $query = $query->Where('name', 'LIKE', "%".$request->searchKeyword."%")
            ->orWhere('business_name', 'LIKE', "%".$request->searchKeyword."%");
        }

        $query->orderByDesc('id');
        
        $data = $query->paginate(15); 

        //$companies = Company::where('enable','1')->get();
        return view('system.companies.app',['companies'=>$data]);
    }   
    public function register(){       
        return view('system.companies.register');
    }   
    public function store(Request $request)
    {
        $this->validate($request, [               
            'name' => 'required|max:255|unique:companies',         
            'business_name' => 'nullable|max:255|unique:companies',         
            'legal_representative' => 'nullable|max:255',         
            'public_deed' => 'nullable|max:255',        
            'rfc' => [ 'nullable', 'unique:companies', 'regex:/^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$/' ], 
        ]); 

        $Company = new Company;

        $Company->name = $request->name;
        $Company->business_name = $request->business_name;
        $Company->legal_representative = $request->legal_representative;
        $Company->public_deed = $request->public_deed;
        $Company->rfc = $request->rfc;
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
            'business_name' => 'nullable|max:255|unique:companies,id,'.$id,       
            'legal_representative' => 'nullable|max:255',         
            'public_deed' => 'nullable|max:255',    
            'rfc' => [ 'nullable', 'unique:companies,id,'.$id, 'regex:/^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$/' ], 
        ]);
        $company = Company::find($id);

        $company->name = $request->name;
        $company->business_name = $request->business_name;
        $company->legal_representative = $request->legal_representative;
        $company->public_deed = $request->public_deed;
        $company->rfc = $request->rfc;
        $company->address = $request->address;
        $company->zip_code = $request->zip_code;

        $company->save();

        return redirect()->route('system.companies');

    }
    public function upload_logo($id){
        $company = Company::find($id);
        return view('system.companies.upload-logo',['company'=>$company,'id'=>$id]);
    }
    public function store_logo(Request $request){
        $this->validate($request, [               
            'id' => 'required|integer',              
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',       
        ]); 

        $company = Company::find($request->id);

        $path = public_path().'/images/logo/';
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
                
        File::delete($path.$company->image);

        if ($image = $request->file('image')) {         
            $logo = str_replace(' ','-',clean_up_string($company->name) . "." . $image->getClientOriginalExtension());
            $image->move($path, $logo);
            //$input['image'] = "$logo";
        }


       


        $company->image = $logo;
        $company->save();

        return redirect()->route('system.companies');
    }
}
