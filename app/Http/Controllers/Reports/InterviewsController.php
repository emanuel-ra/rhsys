<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Interview;
use App\Models\User;
use App\Models\Branch;
use App\Models\JopPosition;

class InterviewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:reports.recruitment.interview.index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
      
        //$interviews = Interview::with('type_interview')->with('User')->with('candidate')->get();
        $query = Interview::query();

        $date_from = (isset($request->date_from)) ? $request->date_from:\Carbon\Carbon::now()->startOfMonth();
        $date_to = (isset($request->date_to)) ? $request->date_to:\Carbon\Carbon::now();
        
        
        $query = $query->whereBetween('interview_date',array($date_from,$date_to));  

        if($request->user_id>0){
            $query = $query->Where('user_interviewer_id', $request->user_id);
        }

        if($request->branch_id>0){
            $query = $query->Where('branch_id', $request->branch_id);
        }

        if($request->jop_position_id>0){
            $query = $query->Where('jop_position_id', $request->jop_position_id);
        }

        $query->with('type_interview');
        $query->with('User');
        $query->with('candidate');

        $query->orderByDesc('id');
        
        $interviews = $query->paginate(50); 

        $users = User::select('id','name')->get();
        $branches = Branch::select('id','name')->where('enable',1)->get();
        $jop_positions = JopPosition::select('id','name')->where('enable',1)->get();

        return view('reports.interviews.app',[
            'interviews'=> $interviews ,
            'users' => $users ,
            'branches' => $branches ,
            'jop_positions' => $jop_positions ,

            'date_from' => $date_from ,
            'date_to' => $date_to ,
        ]);
    }
}
