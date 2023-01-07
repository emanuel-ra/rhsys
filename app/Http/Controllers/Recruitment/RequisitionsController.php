<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\JopPosition;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Status;
use App\Models\Requisitions;
use App\Models\Staff;
use Illuminate\Validation\Rule;


class RequisitionsController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission: recruitment.requisitions.index|recruitment.requisitions.create|recruitment.requisitions.update']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   

        $query = Requisitions::query();

        $query = $query->where('status_id','!=',2);    

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

        $branches = Branch::select('id','name')->where('enable',1)->get();
        $departments = Department::select('id','name')->where('enable',1)->get();
        $jop_positions = JopPosition::select('id','name')->where('enable',1)->get();
        $status = Status::select('id','name')->whereIn('id',array(1))->where('enable',1)->get();

        $query->with('Position');
        $query->with('Department');
        $query->with('Company');
        $query->with('Branch');
        $query->with('Supervisor');
        $query->with('Status');
        $query->with('User');
        $query->with('UserCancel');
        

        $query->orderByDesc('id');
        
        $data = $query->paginate(50); 
        
        return view('recruitment.requisitions.app',[
            'data' => $data ,
            'branches' => $branches ,
            'departments' => $departments ,
            'jop_positions' => $jop_positions ,
            'status' => $status ,

            'branch_id' => $request->branch_id ,
            'department_id' => $request->department_id ,
            'jop_position_id' => $request->jop_position_id ,
            'status_id' => $request->status_id ,
        ]);
    }
    public function create(){

        $companies = Company::select('id','name')->where('enable',1)->get();
        $departments = Department::select('id','name')->where('enable',1)->get();
        $Staff = Staff::select('id','name')->where('status_id',4)->where('supervisor',1)->get();

        return view('recruitment.requisitions.register',[
            'companies' => $companies ,
            'departments' => $departments ,
            'Staff' => $Staff ,
        ]);
    }
    public function store(Request $request)
    {     
        $this->validate($request, [               
            'company_id' => 'required',         
            'branch_id' => 'required',         
            'department_id' => 'required',         
            //'jop_position_id' => 'required',        
            'jop_position_id' => ['required' ,
                Rule::unique('requisitions')->where(function ($query)  use ($request) {
                    return $query->where(
                        [
                            ["branch_id", "=", $request->branch_id] ,
                            ["status_id", "=", 1]
                        ]
                    );
                })
            ] ,
            'supervisor_id' => 'required',       
            'request_quantity' => 'required|integer|min:1',     
            'request_date' => 'required',   
            'commentaries' => 'nullable|max:500',  
        ],
        [
            'jop_position_id.unique' => 'Solo se permite una bacante activa por posición y sucursal a la vez'
        ]);     

        $Requisitions = new Requisitions;

        $Requisitions->company_id = $request->company_id;
        $Requisitions->branch_id = $request->branch_id;
        $Requisitions->department_id = $request->department_id;
        $Requisitions->jop_position_id = $request->jop_position_id;
        $Requisitions->supervisor_id = $request->supervisor_id;
        $Requisitions->request_quantity = $request->request_quantity;
        $Requisitions->request_date = $request->request_date;
        $Requisitions->commentaries = $request->commentaries;
        $Requisitions->user_id = $request->user()->id;
        $Requisitions->status_id = 1;
        $Requisitions->save();
     
        return redirect()->route('recruitment.requisitions');    
    }
    public function cancel(Request $request)
    {        
        $this->validate($request, [               
            'requisition_id' => 'required|integer',         
            'cancelation_reason' => 'required|max:500',                     
        ]);        
        
        $Requisitions = Requisitions::find($request->requisition_id);

        try{
            $Requisitions->cancelation_reason = trim($request->cancelation_reason);
            $Requisitions->cancelation_user_id = $request->user()->id;
            $Requisitions->cancel_date = \Carbon\Carbon::now();
            $Requisitions->status_id = 14;
            $Requisitions->save();
            return redirect()->route('recruitment.requisitions');    
        }
        catch(\Exception $e){
            // do task when error
            //echo $e->getMessage();   // insert query
         }
    }
}
