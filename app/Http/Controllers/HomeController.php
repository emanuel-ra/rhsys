<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\StaffRotation;
use App\Models\Company;
use App\Models\Branch;
use App\Models\Interview;
use App\Models\Candidate;

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

        $companies_count = Company::where('enable',1)->count();
        $branches_count = Branch::where('enable',1)->count();

        $interviews_count = Interview::where('status_id',7)->count();
        $candidates_count = Candidate::where('status_id',1)->where('is_hired',0)->count();

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

        $char_staff_reasons_to_leave_the_work = Staff::selectRaw('reasons_to_leave_works.name reason, count(staff.id) data')
                ->join('reasons_to_leave_works', 'staff.reason_unsubscribe_id' ,'reasons_to_leave_works.id')               
                ->groupBy('staff.reason_unsubscribe_id')
                ->get();
        
        $char_rotation_by_supervisor = StaffRotation::selectRaw('staff.name, count(staff_rotations.supervisor_id) data')
            ->join('staff','staff_rotations.supervisor_id','staff.id')
            ->groupBy('staff_rotations.supervisor_id')
            ->get();

        $char_rotation_by_companies = StaffRotation::selectRaw('companies.name, count(staff_rotations.company_id) data')
            ->join('companies','staff_rotations.company_id','companies.id')
            ->groupBy('staff_rotations.company_id')
            ->get();

        $char_rotation_by_branch = StaffRotation::selectRaw('branches.name, count(staff_rotations.branch_id) data')
            ->join('branches','staff_rotations.branch_id','branches.id')
            ->groupBy('staff_rotations.branch_id')
            ->get();

        $char_rotation_by_jop_position = StaffRotation::selectRaw('jop_positions.name, count(staff_rotations.jop_position_id) data')
            ->join('jop_positions','staff_rotations.jop_position_id','jop_positions.id')
            ->groupBy('staff_rotations.jop_position_id')
            ->get();
        
        return view('dashboard.main',
            [
                'enable_staff' => $enable_staff , // NUMBER OF ENABLE STAFF
                'disabled_staff' => $disabled_staff , // NUMBER OF DISABLED STAFF
                'companies_count' => $companies_count , // NUMBER OF ENABLE STAFF
                'branches_count' => $branches_count , // NUMBER OF DISABLED STAFF
                'interviews_count' => $interviews_count , // NUMBER OF DISABLED STAFF
                'candidates_count' => $candidates_count , 
                
                // DATA TO BUILD CHARTS
                'char_bar_enable' => $char_bar_enable , // STAFF REGISTERED
                'char_bar_disabled' => $char_bar_disabled , // STAFF ENABLED 
                'char_staff_by_department_enable' => $char_staff_by_department_enable , // STAFF ENABLED BY POSITION
                'char_staff_reasons_to_leave_the_work' => $char_staff_reasons_to_leave_the_work , // STAFF ENABLED BY POSITION
                'char_rotation_by_supervisor' => $char_rotation_by_supervisor ,
                'char_rotation_by_companies' => $char_rotation_by_companies ,
                'char_rotation_by_branch' => $char_rotation_by_branch ,
                'char_rotation_by_jop_position' => $char_rotation_by_jop_position ,
            ]
        );
    }
}
