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

    public function getCharts(Request $request){

        $months = ['01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre'];
        
        $start_date  = new \Carbon\Carbon('first day of this month');
        $ended_date  = new \Carbon\Carbon('last day of this month');
        
        if(isset($request->start_date)){
            $start_date  = \Carbon\Carbon::parse($request->start_date);
           
        }
        if(isset($request->ended_date)){
            $ended_date = \Carbon\Carbon::parse("$request->ended_date 23:59:59");
        }
        
        $branches = Branch::select('id','name')->where('enable',1)->get();
        $interviews_by_branch_status = array();
        $interviews_by_branch_attendance = array();
        $interviews_by_year = array();

        $interviews_by_users_complete = Interview::selectRaw('users.name label, count(*) data')
            ->join('users', 'interviews.user_id' ,'users.id')
            ->where('interviews.status_id',13)
            ->whereBetween('interviews.created_at', [$start_date, $ended_date])
            ->groupBy('interviews.user_id')
            ->get();
        
        $interviews_by_types_complete = Interview::selectRaw('type_interviews.name label, count(*) data')
            ->join('type_interviews', 'interviews.type_interview_id' ,'type_interviews.id')
            ->where('interviews.status_id',13)
            ->whereBetween('interviews.created_at', [$start_date, $ended_date])
            ->groupBy('interviews.type_interview_id')
            ->get();

        foreach($branches as $branch)
        {            
            // BY STATUS
            $pendings = Interview::selectRaw('count(*) data')
            ->where('interviews.branch_id',$branch->id)
            ->where('interviews.status_id',7)            
            ->whereBetween('interviews.created_at', [$start_date, $ended_date])
            ->groupBy('status_id')
            ->orderBy('status_id', 'asc')
            ->get();

            $complete = Interview::selectRaw('count(*) data')
            ->where('interviews.branch_id',$branch->id)
            ->where('interviews.status_id',13)            
            ->whereBetween('interviews.created_at', [$start_date, $ended_date])
            ->groupBy('status_id')
            ->orderBy('status_id', 'asc')
            ->get();

            $interviews_by_branch_status[] = array(
                "label" => $branch->name ,
                "data" =>  [(int) @$pendings[0]->data,(int) @$complete[0]->data] ,
            );
            
            // BY ATTENDANCE
            $attendance_one = Interview::selectRaw('count(*) data')
            ->where('interviews.branch_id',$branch->id)
            ->where('attendance',1)
            ->whereBetween('interviews.created_at', [$start_date, $ended_date])
            ->groupBy('attendance')
            ->orderBy('attendance', 'asc')
            ->get();

            $attendance_two = Interview::selectRaw('count(*) data')
            ->where('interviews.branch_id',$branch->id)
            ->where('attendance',2)            
            ->whereBetween('interviews.created_at', [$start_date, $ended_date])
            ->groupBy('attendance')
            ->orderBy('attendance', 'asc')
            ->get();

            $interviews_by_branch_attendance[] = array(
                "label" => $branch->name ,
                "data" =>  [(int) @$attendance_one[0]->data,(int) @$attendance_two[0]->data] ,
            );

            // INTERVIEWS FOR ALL YEAR 
            $dataByMonths = array();
            foreach($months as $month => $nameMonth)
            {
                $result = Interview::selectRaw('year(interview_date) year, month(interview_date) month, count(*) data')
                    ->whereYear('interview_date',date('Y'))
                    ->whereMonth('interview_date',$month)
                    ->where('status_id',13)
                    ->where('branch_id',$branch->id)
                    ->groupBy('year', 'month')
                    ->orderBy('year', 'desc')
                    ->orderBy('month', 'asc')
                    ->get();

                    $dataByMonths[] = (object)['year'=>date('Y'),'month'=>$nameMonth,'data'=>(int) @$result[0]->data];
            }  
            
            $interviews_by_year[] = array(
                "label" => $branch->name ,
                "data" =>  $dataByMonths ,
            );

        }
        
        //return $interviews_by_year;
        
        return view('reports.interviews.charts',[
            'interviews_by_branch_status'=>$interviews_by_branch_status ,
            'interviews_by_branch_attendance'=>$interviews_by_branch_attendance ,
            'interviews_by_users_complete'=>$interviews_by_users_complete ,
            'interviews_by_types_complete' =>$interviews_by_types_complete ,
            'interviews_by_year' =>$interviews_by_year ,

            'start_date' => $start_date ,
            'ended_date' => $ended_date ,
        ]);


    }
}
