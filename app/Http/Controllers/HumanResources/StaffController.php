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
use App\Models\Country;
use App\Models\MaritalStatus;

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
        $this->middleware(['permission: staff.index|staff.create|staff.update|staff.unsubscribe|staff.subscribe']);
    }   
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Staff::where('status_id','!=',2)
        ->with('Position')
        ->with('Department')
        ->with('Company')
        ->with('Branch')
        ->with('MaritalStatus')
        ->with('Scholarship')
        ->with('Country')
        ->with('StateOfACountry')
        ->get();        

        //return $data;
        return view('human-resources.staff.app',['data'=>$data]);
    }   
    public function register(){

        $Company = Company::where('enable',1)->get();      
        $Department = Department::where('enable',1)->get();
        $JopPosition = JopPosition::where('enable',1)->get();
        $Scholarship = Scholarship::where('enable',1)->get();
        $Country = Country::where('enable',1)->get();
        $MaritalStatus = MaritalStatus::where('enable',1)->get();

        return view('human-resources.staff.register',[
            'Company' => $Company ,
            'Department' => $Department ,
            'JopPosition' => $JopPosition ,
            'Scholarship' => $Scholarship ,
            'Country' => $Country ,     
            'MaritalStatus' => $MaritalStatus ,            
        ]);
    }   
    public function store(Request $request)
    {
        $this->validate($request, [               
            'code' => 'required|max:255|unique:staff',         
            'name' => 'required|max:255',     
            'email' => 'required|email|max:255',                 
            'mobile_phone' => 'required|max:15',            
            'company_id' => 'required',
            'branch_id' => 'required',
            'jop_position_id' => 'required',
            'department_id' => 'required',
            'scholarship_id' => 'required',
            'maritial_status_id' => 'required',
            'country_id' => 'nullable',
            'state_of_a_country_id' => 'nullable',
            'socioeconomic' => 'required',
            'hired_date' => 'required|max:10',
            'born_date' => 'required|max:10',


            'rfc' => [ 'nullable', 'unique:staff', 'regex:/^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$/' ],
            'curp' => [ 'nullable', 'unique:staff', 'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/' ],
            'nss' => [ 'nullable', 'unique:staff', 'regex:/^(\d{2})(\d{2})(\d{2})\d{5}$/' ],
        
        ]);       
       
        $Staff = new Staff;       

        $Staff->name = $request->name;
        $Staff->code = $request->code;
        $Staff->genre = $request->genre;
        $Staff->curp = $request->curp;
        $Staff->rfc = $request->rfc;
        $Staff->nss = $request->nss;
        $Staff->email = $request->email;
        $Staff->mobile_phone = $request->mobile_phone;
        $Staff->address = $request->address;
        $Staff->suburb = $request->suburb;
        $Staff->zip_code = $request->zip_code;
        $Staff->town = $request->town;
        $Staff->city = $request->city;
        $Staff->bank_account = $request->bank_account;
        $Staff->company_id = $request->company_id;
        $Staff->branch_id = $request->branch_id;
        $Staff->jop_position_id = $request->jop_position_id;
        $Staff->department_id = $request->department_id;
        $Staff->scholarship_id = $request->scholarship_id;
        $Staff->maritial_status_id = $request->maritial_status_id;
        $Staff->country_id = $request->country_id;
        $Staff->state_of_a_country_id = $request->state_of_a_country_id;
        $Staff->status_id = $request->status_id;
        $Staff->socioeconomic = $request->socioeconomic;
        $Staff->hired_date = $request->hired_date;
        $Staff->status_id = 1;
        if($request->hired_date!='')
            $Staff->born_date = $request->hired_date;      
        if($request->born_date!='')
            $Staff->born_date = $request->born_date;        
        if($request->expiration_date!='')
            $Staff->expiration_date = $request->expiration_date;

        $Staff->save();
        return redirect()->route('hr.staff');
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
