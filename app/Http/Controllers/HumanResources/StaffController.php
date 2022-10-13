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
use App\Models\StaffRotation;
use App\Models\Status;
use Carbon\Carbon;
use PDF;

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
        $this->middleware(['permission: staff.index|staff.create|staff.update|staff.unsubscribe|staff.subscribe|staff.contract']);
         // Configuración para fechas en español
        \Carbon\Carbon::setUTF8(true);
        \Carbon\Carbon::setLocale(config('app.locale'));
        setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');
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

        if(isset($request->branch_id)){
            $query = $query->Where('branch_id', $request->branch_id);
        }

        if(isset($request->department_id)){
            $query = $query->Where('department_id', $request->department_id);
        }

        if(isset($request->jop_position_id)){
            $query = $query->Where('jop_position_id', $request->jop_position_id);
        }

        if(isset($request->status_id)){
            $query = $query->Where('status_id', $request->status_id);
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


        $branches = Branch::select('id','name')->where('enable',1)->get();
        $departments = Department::select('id','name')->where('enable',1)->get();
        $jop_positions = JopPosition::select('id','name')->where('enable',1)->get();
        $status = Status::select('id','name')->whereIn('id',array(4,5))->where('enable',1)->get();
        return view('human-resources.staff.app',[
            'data'=>$data ,
            'branches'=>$branches ,
            'departments'=>$departments ,
            'jop_positions'=>$jop_positions ,
            'status'=>$status ,

            'keyword' => $request->searchKeyword ,
            'branch_id' => $request->branch_id ,
            'department_id' => $request->department_id ,
            'jop_position_id' => $request->jop_position_id ,
            'status_id' => $request->status_id ,
            
        ]);
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
        ->with('Boss')             
        ->find($id);   
       
        return view('human-resources.staff.view',[
            'data'=>$data
        ]);
    }
    public function register(){

        $Supervisor = Staff::select('id','name')->where('status_id',4)->where('supervisor',1)->get();
        $Company = Company::select('id','name')->where('enable',1)->get();
        $Department = Department::select('id','name')->where('enable',1)->get();
        $JopPosition = JopPosition::select('id','name')->where('enable',1)->get();
        $Scholarship = Scholarship::select('id','name')->where('enable',1)->get();
        $Country = Country::select('id','name')->where('enable',1)->get();
        $MaritalStatus = MaritalStatus::select('id','name')->where('enable',1)->get();
    
        return view('human-resources.staff.register',[        
            'Supervisor' => $Supervisor ,   
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
            'code' => 'required|max:20|unique:staff',         
            'checker_code' => 'nullable|max:20|unique:staff',         
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

            'rfc' => [ 'nullable','max:20', 'unique:staff', 'regex:/^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$/' ],
            'curp' => [ 'nullable','max:20', 'unique:staff', 'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/' ],
            'nss' => [ 'nullable','max:20', 'unique:staff', 'regex:/^(\d{2})(\d{2})(\d{2})\d{5}$/' ],
            
            'activities' => 'nullable|max:550' ,
        ]);     
        
        
        $working_hours = [
            'monday' => [
                'enable' => (count($request->monday)>2) ? true :false ,
                'start' => (count($request->monday)>2) ? $request->monday[1] :'' ,
                'end' => (count($request->monday)>2) ? $request->monday[2] :'' ,
            ],
            'tuesday' => [
                'enable' => (count($request->tuesday)>2) ? true :false ,
                'start' => (count($request->tuesday)>2) ? $request->tuesday[1] :'' ,
                'end' => (count($request->tuesday)>2) ? $request->tuesday[2] : '' ,
            ],
            'wednesday' => [
                'enable' => (count($request->wednesday)>2) ? true :false ,
                'start' => (count($request->wednesday)>2) ? $request->wednesday[1] : '' ,
                'end' => (count($request->wednesday)>2) ? $request->wednesday[2] : '' ,
            ],
            'thursday' => [
                'enable' => (count($request->thursday)>2) ? true :false ,
                'start' => (count($request->thursday)>2) ? $request->thursday[1] : '' ,
                'end' => (count($request->thursday)>2) ? $request->thursday[2] : '' ,
            ],
            'friday' => [
                'enable' => (count($request->friday)>2) ? true :false ,
                'start' => (count($request->friday)>2) ? $request->friday[1] :'' ,
                'end' =>  (count($request->friday)>2) ? $request->friday[2] : '' ,
            ],
            'saturday' => [
                'enable' => (count($request->saturday)>2) ? true :false ,
                'start' => (count($request->saturday)>2) ? $request->saturday[1]: '' ,
                'end' => (count($request->saturday)>2) ? $request->saturday[2] : '' ,
            ],
            'sunday' => [
                'enable' => (count($request->sunday)>2) ? true :false ,
                'start' => (count($request->sunday)>2) ? $request->sunday[1] : '' ,
                'end' => (count($request->sunday)>2) ? $request->sunday[2] : '' ,
            ]
        ];

               
        $Staff = new Staff;       

        $Staff->name = $request->name;
        $Staff->code = $request->code;
        $Staff->checker_code = $request->checker_code;
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
        $Staff->supervisor = $request->supervisor;        
        $Staff->supervisor_id = $request->supervisor_id;        
        $Staff->hired_date = $request->hired_date;
        $Staff->status_id = 4;
        $Staff->working_hours = json_encode($working_hours);
        $Staff->daily_salary = $request->daily_salary;
        $Staff->user_id = $request->user()->id;
        $Staff->activities = $request->activities;
        
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
        $StaffLogs->data = json_encode($Staff);
        $StaffLogs->save();

        return redirect()->route('hr.staff');
    }
    public function edit($id){

        $Staff = Staff::find($id);       
        $Supervisor = Staff::select('id','name')->where('status_id',4)->where('id','!=',$id)->where('supervisor',1)->get();
        $Company = Company::select('id','name')->where('enable',1)->get();      
        $Department = Department::select('id','name')->where('enable',1)->get();
        $JopPosition = JopPosition::select('id','name')->where('enable',1)->get();
        $Scholarship = Scholarship::select('id','name')->where('enable',1)->get();
        $Country = Country::select('id','name')->where('enable',1)->get();
        $MaritalStatus = MaritalStatus::select('id','name')->where('enable',1)->get();
        //return $Staff;
        return view('human-resources.staff.edit',[
            'Staff' => $Staff ,
            'Supervisor' => $Supervisor ,
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
            'code' => 'required|max:20|unique:staff,code,'.$id.',id' ,  
            'checker_code' => 'nullable|max:20|unique:staff,code,'.$id.',id' ,      
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


            'rfc' => [ 'nullable','max:20', 'unique:staff,id,'.$id, 'regex:/^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$/' ],
            'curp' => [ 'nullable','max:20', 'unique:staff,id,'.$id, 'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/' ],
            'nss' => [ 'nullable','max:20', 'unique:staff,id,'.$id, 'regex:/^(\d{2})(\d{2})(\d{2})\d{5}$/' ],

            'activities' => 'nullable|max:550' ,
        
        ]);   
        
        $working_hours = [
            'monday' => [
                'enable' => (count($request->monday)>2) ? true :false ,
                'start' => (count($request->monday)>2) ? $request->monday[1] :'' ,
                'end' => (count($request->monday)>2) ? $request->monday[2] :'' ,
            ],
            'tuesday' => [
                'enable' => (count($request->tuesday)>2) ? true :false ,
                'start' => (count($request->tuesday)>2) ? $request->tuesday[1] :'' ,
                'end' => (count($request->tuesday)>2) ? $request->tuesday[2] : '' ,
            ],
            'wednesday' => [
                'enable' => (count($request->wednesday)>2) ? true :false ,
                'start' => (count($request->wednesday)>2) ? $request->wednesday[1] : '' ,
                'end' => (count($request->wednesday)>2) ? $request->wednesday[2] : '' ,
            ],
            'thursday' => [
                'enable' => (count($request->thursday)>2) ? true :false ,
                'start' => (count($request->thursday)>2) ? $request->thursday[1] : '' ,
                'end' => (count($request->thursday)>2) ? $request->thursday[2] : '' ,
            ],
            'friday' => [
                'enable' => (count($request->friday)>2) ? true :false ,
                'start' => (count($request->friday)>2) ? $request->friday[1] :'' ,
                'end' =>  (count($request->friday)>2) ? $request->friday[2] : '' ,
            ],
            'saturday' => [
                'enable' => (count($request->saturday)>2) ? true :false ,
                'start' => (count($request->saturday)>2) ? $request->saturday[1]: '' ,
                'end' => (count($request->saturday)>2) ? $request->saturday[2] : '' ,
            ],
            'sunday' => [
                'enable' => (count($request->sunday)>2) ? true :false ,
                'start' => (count($request->sunday)>2) ? $request->sunday[1] : '' ,
                'end' => (count($request->sunday)>2) ? $request->sunday[2] : '' ,
            ]
        ];
        
        $Staff = Staff::find($id);

        $Staff->name = $request->name;
        $Staff->code = $request->code;
        $Staff->checker_code = $request->checker_code;
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
        $Staff->supervisor = $request->supervisor;        
        $Staff->supervisor_id = $request->supervisor_id;            
        $Staff->socioeconomic = $request->socioeconomic;
        $Staff->hired_date = $request->hired_date;        
        $Staff->born_date = $request->hired_date;      
        $Staff->born_date = $request->born_date;      
        $Staff->working_hours = json_encode($working_hours);  
        $Staff->expiration_date = $request->expiration_date;
        $Staff->daily_salary = $request->daily_salary;
        $Staff->activities = $request->activities;
        $Staff->save();


        $StaffLogs = new StaffLogs;
        $StaffLogs->staff_id =  $id;
        $StaffLogs->user_id =  $request->user()->id;
        $StaffLogs->description =  'Actualizado';
        $StaffLogs->data = json_encode($Staff);
        $StaffLogs->save();

        return redirect()->route('hr.staff.view',['id'=>$id]);

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
        $StaffLogs->data = json_encode($Staff);
        $StaffLogs->save();

        $StaffRotation = new StaffRotation;     
        $StaffRotation->staff_id = $Staff->id;
        $StaffRotation->supervisor_id = $Staff->supervisor_id;
        $StaffRotation->company_id = $Staff->company_id;
        $StaffRotation->branch_id = $Staff->branch_id;
        $StaffRotation->department_id = $Staff->department_id;
        $StaffRotation->jop_position_id = $Staff->jop_position_id;
        $StaffRotation->scholarship_id = $Staff->scholarship_id;
        $StaffRotation->save();

        return redirect()->route('hr.staff.view',['id'=>$request->id]);
    }
    public function pdf_contract($id){
        
        $data = Staff::with('Country')->with('MaritalStatus')->with('Position')->find($id);
        $Company = Company::find($data->company_id);
                
        $pdf = Pdf::loadView('pdf.human-resources.staff.contract', ['data'=>$data,'Company'=>$Company]);
        return $pdf->stream();
    }
}
