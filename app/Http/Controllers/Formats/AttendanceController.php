<?php

namespace App\Http\Controllers\Formats;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use \Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Staff;
use PDF;

class AttendanceController extends Controller
{
    /**
     * * Create a new controller instance.
     * @desc This Controller is responsible to the generate the format for attendance
     * @author Tomas Emanuel Ramirez Abarca
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware(['permission: staff.index|staff.create|staff.update|staff.unsubscribe|staff.subscribe|staff.contract']);
         // Configuración para fechas en español
        \Carbon\Carbon::setUTF8(true);
        \Carbon\Carbon::setLocale(config('app.locale'));
        setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');
    }   
    
    /**
     * * Show the application staff.
     * @desc Show the main template, is a form      
     * @param string searchKeyword this parameter is filter the list by name,email,mobile pone, curp, rfc, city, zip code, suburb, genre, code
     * @param int branch_id filter by branch
     * @param int department_id filter by department 
     * @param int jop_position_id filter by jop position 
     * @param int status_id filter by status of the staff
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {  
        $companies = Company::select('id','name')->where('enable',1)->get();       
        return view('formats.attendance',[
            'companies'=>$companies ,            
        ]);
    }
    /**
     * * Show a PDF Document
     * @desc it's a format that show the staff by company, it's used for attendance control, the person need to sign a write the arrive time, lunch time or leave time  
     */
    public function download(Request $request){        

        $this->validate($request,[            
            'company_id'=>'required' ,
            'title'=>'required' ,
            'start_date'=>'required' ,
            //'end_date'=>'required'
        ]);

        $end_date = Carbon::parse($request->start_date)->addDays(7);

        $period = CarbonPeriod::between($request->start_date, $end_date);

        $staff = Staff::where('status_id',4)->where('company_id',$request->company_id)->orderBy('name')->get();
        $company = Company::select('id','name')->find($request->company_id);    

        $pdf = Pdf::loadView('pdf.formats.attendance', [
            'period'=>$period ,
            'title'=>$request->title ,
            'start_date'=>$request->start_date ,
            'end_date'=>$end_date ,
            'staff'=>$staff ,
            'company'=>$company,
            'rows' => 0 ,
        ]);
        return $pdf->stream();
    }
}
