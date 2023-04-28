<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

use App\Models\Company;
use App\Models\Branch;
use App\Models\AuthorizedPost;
use App\Models\JopPosition;
use App\Models\Staff;


class CensusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:reports.census.index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $Branch = Branch::select('id','name')->where('enable',1)->get();
        $JopPosition = JopPosition::select('id','name')->where('enable',1)->get();
        $data = [];
       
        foreach($JopPosition as $row)
        {
            $authorized = [];
            $position_id = $row->id;
            foreach($Branch as $row2)
            {
                $branch_id = $row2->id;
                $AuthorizedPost = AuthorizedPost::select('quantity')->where('branch_id',$branch_id)->where('jop_position_id',$position_id)->get();
                $authorized[] = array(
                    'branch_name' => $row2->name ,
                    'authorized' => $AuthorizedPost[0]->quantity ,
                    'staff_quantity' => Staff::where('branch_id',$branch_id)->where('status_id',4)->where('jop_position_id',$position_id)->count() ,              
                );
            }
            $data[] = array('puesto'=>$row->name, 'authorized' => $authorized);
        }
               
        return view('reports.census.app',['data'=>$data]);
    }
    public function getCharts(Request $request){
        $Branches = Branch::select('id','name')->where('enable',1)->get();
        $JopPosition = JopPosition::select('id','name')->where('enable',1)->get();
        $data = [];
       
        foreach($Branches as $Branch)
        {
            $branch_id = $Branch->id;
            $authorized = [];
            foreach($JopPosition as $row)
            {
                $position_id = $row->id;
                $AuthorizedPost = AuthorizedPost::select('quantity')->where('branch_id',$branch_id)->where('jop_position_id',$position_id)->get();
                $authorized[] = array(
                    'label' => $row->name ,
                    'authorized' => $AuthorizedPost[0]->quantity ,
                    'staff_quantity' => Staff::where('branch_id',$branch_id)->where('status_id',4)->where('jop_position_id',$position_id)->count() ,              
                );
            }

            $data[] = array(
                'branch_name'=> $Branch->name, 
                'uuid' => (string) Str::uuid() , 
                'authorized' => $authorized
            );            
        }        
        //return $data;
        return view('reports.census.charts',['data'=>$data]);

    }
}
