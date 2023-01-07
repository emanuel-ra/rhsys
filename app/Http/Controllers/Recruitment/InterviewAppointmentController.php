<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\TypeInterview;
use App\Models\Interview;
use Illuminate\Support\Facades\DB;

class InterviewAppointmentController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware(['permission: recruitment.prospects.index|recruitment.prospects.create|recruitment.prospects.update']);
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
        return view('recruitment.interview.app');
    }
    public function create($id)
    {
        $data = Candidate::find($id);
        $TypeInterview = TypeInterview::where('enable',1)->get();
        return view('recruitment.interview.register',[
            'data'=>$data ,
            'TypeInterview' => $TypeInterview
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [               
            'candidate_id' => 'required|integer',         
            'type_interview_id' => 'required|integer',         
            'interview_date' => ['required','after:today'] ,
            'commentaries' => ['nullable','max:500'] 
        ]
        );     

        $Interview = new Interview;

        $Interview->commentaries = $request->commentaries;
        $Interview->candidate_id = $request->candidate_id;
        $Interview->status_id = 7;
        $Interview->type_interview_id = $request->type_interview_id;
        $Interview->user_id = $request->user()->id;
        $Interview->interview_date = \Carbon\Carbon::create($request->interview_date);
        $Interview->save();
       
        return redirect()->route('recruitment.interview.appointment');
    }
    public function open($id){

        $data = Interview::with('candidate')->with('status')->with('type_interview')->find($id);
        
        if($data->status_id==13){
            return view('recruitment.interview.view',['data' => $data ,]);
        }

        $TypeInterview = TypeInterview::where('enable',1)->get();

        return view('recruitment.interview.tracing',[
            'data' => $data ,
            'TypeInterview' => $TypeInterview ,
        ]);
       
    }
    public function tracing(Request $request)
    {
        $this->validate($request, [               
                'id' => 'required|integer',         
                'attendance' => 'required|integer',         
                'observations' => ['nullable','max:500'] ,
                'interview_new_date' => 'required_with:reschedule,on'
            ]
        );   

        $Interview = Interview::find($request->id);

        if(isset($request->reschedule)){
            $new = new Interview;
            $new->commentaries = "";
            $new->candidate_id = $Interview->candidate_id;
            $new->status_id = 7;
            $new->type_interview_id = $Interview->type_interview_id;
            $new->user_interviewer_id = $request->user()->id;
            $new->interview_date = \Carbon\Carbon::create($request->interview_new_date);
            $new->save();
        }
        
        $Interview->attendance = (int) $request->attendance;
        $Interview->reschedule = (isset($request->reschedule)) ? 1:0;
        $Interview->updated_at = \Carbon\Carbon::now();
        $Interview->observations = $request->observations;
        $Interview->status_id = 13;

        $Interview->reschedule_id = (isset($request->reschedule)) ? $new->id:0;
        $Interview->reschedule_date = (isset($request->reschedule)) ? \Carbon\Carbon::create($request->interview_new_date):null;

        $Interview->save();
        
        return redirect()->route('recruitment.interview.appointment');
    }
    public function getJson(Request $request){
        //$data = Interview::with('prospect')->with('status')->with('type_interview')->get();
        $this->validate($request, [               
                'start' => 'required',         
                'end' => 'required',         
            ]
        );   
        
        $data = DB::table('interviews AS A')  
        ->join('candidates AS B', 'A.candidate_id','=','B.id')
        ->select(
            'A.id',
            'B.name as title',
            'interview_date AS start',
            DB::raw('DATE_ADD(interview_date, INTERVAL 30 MINUTE) as end') ,
            DB::raw("CONCAT('".url('recruitment/interview/appointment/open')."', '/', A.id) as url") ,
            )
        ->whereBetween('interview_date',[$request->start,$request->end])
        ->get();

        return Response()->json($data,200);
    }
}
