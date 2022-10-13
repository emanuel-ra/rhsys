<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prospects;
use App\Models\ProspectSource;
use App\Models\Requisitions;
use App\Models\Status;

class ProspectsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission: recruitment.prospects.index|recruitment.prospects.create|recruitment.prospects.update']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   

        $query = Prospects::query();

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

        // $branches = Branch::select('id','name')->where('enable',1)->get();
        // $departments = Department::select('id','name')->where('enable',1)->get();
        // $jop_positions = JopPosition::select('id','name')->where('enable',1)->get();
        $status = Status::select('id','name')->whereIn('id',array(1,8,9,10,11))->where('enable',1)->get();

        $query->with('ProspectSource');
        $query->with('Requisitions');
        // $query->with('Company');
        // $query->with('Branch');
        // $query->with('Supervisor');
        // $query->with('Status');
        
        $query->orderByDesc('id');
        
        $data = $query->paginate(50); 
        //return $data;
        //$data = Requisitions::paginate(10);
        return view('recruitment.prospects.app',[
            'data' => $data ,
            // 'branches' => $branches ,
            // 'departments' => $departments ,
            // 'jop_positions' => $jop_positions ,
            'status' => $status ,

            'branch_id' => $request->branch_id ,
            'department_id' => $request->department_id ,
            'jop_position_id' => $request->jop_position_id ,
            'status_id' => $request->status_id ,
        ]);
    }
    public function create(){

        $ProspectSource = ProspectSource::select('id','name')->where('enable',1)->get();
        $Requisitions = Requisitions::select('id','jop_position_id','branch_id')->with('Position')->with('Branch')->get();
        //return $Requisitions;
        //$Staff = Staff::select('id','name','jop_position_id')->where('status_id',4)->where('supervisor',1)->get();
        return view('recruitment.prospects.register',[
            'ProspectSource' => $ProspectSource ,
            'Requisitions' => $Requisitions ,
            //'Staff' => $Staff ,
        ]);
    }
    public function store(Request $request)
    {     
        $this->validate($request, [               
            'name' => 'required|max:255',         
            'email' => ['required_without:mobile_phone','max:255'] ,
            'mobile_phone' => ['required_without:email','max:255'] ,            
            'sources_id' => 'required|integer', 
            'requisition_id' => 'required|integer', 
        ]
        );     

        $Prospects = new Prospects;

        $Prospects->name = $request->name;
        $Prospects->email = $request->email;
        $Prospects->mobile_phone = $request->mobile_phone;
        $Prospects->requisition_id = $request->requisition_id;
        $Prospects->sources_id = $request->sources_id;
        $Prospects->status_id = 1;
        $Prospects->user_id = $request->user()->id;
        $Prospects->save();
     
        return redirect()->route('recruitment.prospects');    
    }
}
