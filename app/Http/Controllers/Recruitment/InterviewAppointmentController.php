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
            'prospect_id' => 'required|integer',         
            'type_interview_id' => 'required|integer',         
            'interview_date' => ['required','after:today'] ,
            'commentaries' => ['nullable','max:500'] 
        ]
        );     

        $Interview = new Interview;

        $Interview->commentaries = $request->commentaries;
        $Interview->prospect_id = $request->prospect_id;
        $Interview->status_id = 1;
        $Interview->type_interview_id = $request->type_interview_id;
        $Interview->user_id = $request->user()->id;
        $Interview->interview_date = \Carbon\Carbon::create($request->interview_date);
        $Interview->save();
       
        return redirect()->route('recruitment.interview.appointment');
    }
    public function open($id){
        $data = Interview::with('prospect')->with('status')->with('type_interview')->find($id);
       
        if($data->attendance){
            return view('recruitment.interview.view',['data' => $data ,]);
        }
        return view('recruitment.interview.tracing',[
            'data' => $data ,
        ]);
       
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
