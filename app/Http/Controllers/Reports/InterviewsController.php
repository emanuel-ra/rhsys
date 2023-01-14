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
        $this->middleware(['permission:reports.interview.index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        $query = Interview::query();

        $date_from = (isset($request->date_from)) ? $request->date_from:\Carbon\Carbon::now()->startOfMonth();
        $date_to = (isset($request->date_to)) ? $request->date_to:\Carbon\Carbon::now();        
        
        $query = $query->whereBetween('interview_date',array("$date_from 00:00:00","$date_to 23:59:59"));  

        if($request->user_id>0){
            $query = $query->Where('user_interviewer_id', $request->user_id);
        }

        if($request->branch_id>0){
            $query = $query->Where('branch_id', $request->branch_id);
        }

        if($request->attended!=="all"){
            $query = $query->Where('attendance', (int) $request->attended);
        }
        
        $query->with('type_interview');
        $query->with('UserCreated');
        $query->with('UserInterview');
        $query->with('candidate');

        $query->orderByDesc('id');
        
        $interviews = $query->paginate(25)->withQueryString(); 

        $users = User::select('id','name')->get();
        $branches = Branch::select('id','name')->where('enable',1)->get();
      
        return view('reports.interviews.app',[
            'interviews'=> $interviews ,
            'users' => $users ,
            'branches' => $branches ,

            'date_from' => $date_from ,
            'date_to' => $date_to ,

            'attendedOpt' => array(
                '0'=>'Pendientes' ,
                '1'=>'Asistió' ,
                '2'=>'No Asistió' ,
            ) ,                        
            'req' => $request ,           
        ]);
    }
}
