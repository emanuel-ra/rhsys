<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Staff;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        $enable_staff = Staff::where('status_id',4)->count();
        $disabled_staff = Staff::where('status_id',5)->count();
      
        $char_bar_enable = Staff::selectRaw('year(hired_date) year, monthname(hired_date) month, count(*) data')
                ->whereYear('hired_date',date('Y'))
                ->where('status_id',4)
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'asc')
                ->get();
        

        $char_bar_disabled = Staff::selectRaw('year(hired_date) year, monthname(hired_date) month, count(*) data')
                ->whereYear('hired_date',date('Y'))
                ->where('status_id',5)
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'asc')
                ->get();

        $char_staff_by_department_enable = Staff::selectRaw('departments.name department, count(staff.id) data')
                ->join('departments', 'staff.department_id' ,'departments.id')
                ->where('status_id',4)
                ->groupBy('staff.department_id')
                ->get();


        $char_staff_by_position_enable = Staff::selectRaw('jop_positions.name puesto, count(staff.id) data')
                ->join('jop_positions', 'staff.jop_position_id' ,'jop_positions.id')
                ->where('status_id',4)
                ->groupBy('staff.jop_position_id')
                ->get();
        
        $char_staff_reasons_to_leave_the_work = Staff::selectRaw('reasons_to_leave_works.name reason, count(staff.id) data')
                ->join('reasons_to_leave_works', 'staff.reason_unsubscribe_id' ,'reasons_to_leave_works.id')               
                ->groupBy('staff.reason_unsubscribe_id')
                ->get();
        
        
      

        return view('dashboard.main',
            [
                'enable_staff' => $enable_staff , // NUMBER OF ENABLE STAFF
                'disabled_staff' => $disabled_staff , // NUMBER OF DISABLED STAFF
                
                // DATA TO BUILD CHARTS
                'char_bar_enable' => $char_bar_enable , // STAFF REGISTERED
                'char_bar_disabled' => $char_bar_disabled , // STAFF ENABLED 

                'char_staff_by_position_enable' => $char_staff_by_position_enable , // STAFF ENABLED BY POSITION
                'char_staff_by_department_enable' => $char_staff_by_department_enable , // STAFF ENABLED BY POSITION
                'char_staff_reasons_to_leave_the_work' => $char_staff_reasons_to_leave_the_work , // STAFF ENABLED BY POSITION
            ]
        );
    }
}
