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
use App\Models\ReasonsToLeaveWork;
use App\Models\StaffLogs;
use Carbon\Carbon;

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
    public function index(Request $request)
    {
     
        $query = Staff::query();

        $query = $query->where('status_id','!=',2);
        
        
        if(isset($request->searchKeyword)){
            $query = $query->Where('name', 'LIKE', "%".$request->searchKeyword."%")
                    ->orWhere('email', 'LIKE', "%".$request->searchKeyword."%")
                    ->orWhere('mobile_phone', 'LIKE', "%".$request->searchKeyword."%")
                    ->orWhere('curp', 'LIKE', "%".$request->searchKeyword."%")
                    ->orWhere('rfc', 'LIKE', "%".$request->searchKeyword."%")
                    ->orWhere('city', 'LIKE', "%".$request->searchKeyword."%")
                    ->orWhere('zip_code', 'LIKE', "%".$request->searchKeyword."%")
                    ->orWhere('suburb', 'LIKE', "%".$request->searchKeyword."%")
                    ->orWhere('genre', 'LIKE', "%".$request->searchKeyword."%")
                    ->orWhere('code', 'LIKE', "%".$request->searchKeyword."%");
        }

        $query->with('User');
        $query->with('Position');
        $query->with('Department');
        $query->with('Company');
        $query->with('Branch');
        $query->with('MaritalStatus');
        $query->with('Scholarship');
        $query->with('Country');
        $query->with('State');
        $query->with('Status');
        
        $query->orderByDesc('id');

        $data = $query->paginate(50); 

        return view('human-resources.staff.app',['data'=>$data,'keyword' => $request->searchKeyword]);
    }  
    public function view($id){
       
        $data = Staff::with('User')
        ->with('Position')
        ->with('Department')
        ->with('Company')
        ->with('Branch')
        ->with('MaritalStatus')
        ->with('Scholarship')
        ->with('Country')
        ->with('State')
        ->with('Status')
        ->with('unsubscribe')  
        ->with('stafflogs')         
        ->find($id);        
        //return $data;
        return view('human-resources.staff.view',['data'=>$data]);
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
            'state_id' => 'nullable',
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
        $Staff->state_id = $request->state_id;
        $Staff->status_id = $request->status_id;
        $Staff->socioeconomic = $request->socioeconomic;
        $Staff->hired_date = $request->hired_date;
        $Staff->status_id = 4;
        $Staff->user_id = $request->user()->id;
        if($request->hired_date!='')
            $Staff->born_date = $request->hired_date;      
        if($request->born_date!='')
            $Staff->born_date = $request->born_date;        
        if($request->expiration_date!='')
            $Staff->expiration_date = $request->expiration_date;

        $Staff->save();

        $StaffLogs = new StaffLogs;
        $StaffLogs->staff_id =  $Staff->id;
        $StaffLogs->user_id =  $request->user()->id;
        $StaffLogs->description =  'Alta';
        $StaffLogs->save();

        return redirect()->route('hr.staff');
    }
    public function edit($id){
        $Staff = Staff::find($id);       
        $Company = Company::where('enable',1)->get();      
        $Department = Department::where('enable',1)->get();
        $JopPosition = JopPosition::where('enable',1)->get();
        $Scholarship = Scholarship::where('enable',1)->get();
        $Country = Country::where('enable',1)->get();
        $MaritalStatus = MaritalStatus::where('enable',1)->get();
        //return $Staff;
        return view('human-resources.staff.edit',[
            'Staff' => $Staff ,
            'Company' => $Company ,
            'Department' => $Department ,
            'JopPosition' => $JopPosition ,
            'Scholarship' => $Scholarship ,
            'Country' => $Country ,     
            'MaritalStatus' => $MaritalStatus ,
            'id' => $id ,
        ]);
    }
    public function update($id,Request $request)
    {

        $this->validate($request, [               
            'code' => 'required|max:255|unique:staff,id,'.$id,
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
            'state_id' => 'nullable',
            'socioeconomic' => 'required',
            'hired_date' => 'required|max:10',
            'born_date' => 'required|max:10',


            'rfc' => [ 'nullable', 'unique:staff,id,'.$id, 'regex:/^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$/' ],
            'curp' => [ 'nullable', 'unique:staff,id,'.$id, 'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/' ],
            'nss' => [ 'nullable', 'unique:staff,id,'.$id, 'regex:/^(\d{2})(\d{2})(\d{2})\d{5}$/' ],
        
        ]);   
       
        $Staff = Staff::find($id);

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
        $Staff->state_id = $request->state_id;
        $Staff->status_id = $request->status_id;
        $Staff->socioeconomic = $request->socioeconomic;
        $Staff->hired_date = $request->hired_date;        
        $Staff->born_date = $request->hired_date;      
        $Staff->born_date = $request->born_date;        
        $Staff->expiration_date = $request->expiration_date;

        $Staff->save();


        $StaffLogs = new StaffLogs;
        $StaffLogs->staff_id =  $id;
        $StaffLogs->user_id =  $request->user()->id;
        $StaffLogs->description =  'Actualizado';
        $StaffLogs->save();

        return redirect()->route('hr.staff');

    }
    public function unsubscribe_from($id){
        $data = Staff::find($id);

        if(!$data){ abort(404); }

        $ReasonsToLeaveWork = ReasonsToLeaveWork::where('enable',1)->get();


        return view('human-resources.staff.unsubscribe',[
            'data'=>$data ,
            'ReasonsToLeaveWork'=>$ReasonsToLeaveWork ,
        ]);       
    }
    public function unsubscribe(Request $request){
        $this->validate($request, [               
            'id' => 'required|integer',         
            'reason_unsubscribe_id' => 'required|integer',  
            'reason_unsubscribe_text' => 'required_if:reason_unsubscribe_id,==,0|nullable',  
        ]);

        $Staff = Staff::find($request->id);
        
        $Staff->reason_unsubscribe_id = $request->reason_unsubscribe_id;
        $Staff->reason_unsubscribe_text =  $request->reason_unsubscribe_text;
        $Staff->unsubscribe_date =  Carbon::now();
        $Staff->status_id =  5;
        $Staff->save();

        $StaffLogs = new StaffLogs;
        $StaffLogs->staff_id = $request->id;
        $StaffLogs->user_id =  $request->user()->id;
        $StaffLogs->description =  'Baja';
        $StaffLogs->save();

        return redirect()->route('hr.staff.view',['id'=>$request->id]);
    }
}
