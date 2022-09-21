<?php

namespace App\Http\Controllers\HumanResources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Department;
use App\Models\JopPosition;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Scholarship;

class StaffController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:admin','permission: staff.index|staff.create|staff.update|staff.unsubscribe|staff.subscribe']);
    }   
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Staff::get();        
        return view('human-resources.staff.app',['data'=>$data]);
    }   
    public function register(){

        $Company = Company::where('enable',1)->get();      
        $Department = Department::where('enable',1)->get();
        $JopPosition = JopPosition::where('enable',1)->get();
        $Scholarship = Scholarship::where('enable',1)->get();

        return view('human-resources.staff.register',[
            'Company' => $Company ,
            'Department' => $Department ,
            'JopPosition' => $JopPosition ,
            'Scholarship' => $Scholarship ,
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
