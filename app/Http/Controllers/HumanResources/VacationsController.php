<?php

namespace App\Http\Controllers\HumanResources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Vacation;
use App\Models\VacationTable;
use Carbon\Carbon;
use PDF;

class VacationsController extends Controller
{
    /**
     * * Create a new controller instance.
     * @desc This Controller is responsible to the vacations
     * @author Tomas Emanuel Ramirez Abarca
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:staff.vacations.request']);
         // Configuración para fechas en español
        \Carbon\Carbon::setUTF8(true);
        \Carbon\Carbon::setLocale(config('app.locale'));
        setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');
    }   
    /**
     * * FORM TO CREATE REQUEST OF VACATIONS
     * @desc SHOW FORM TO CREATE A VACATIONS REQUEST 
     */
    public function form($id){

        $Staff = Staff::with('Position')
        ->with(['Department'])
        ->with('Company')
        ->with('Branch')
        ->with('vacations')
        ->find($id);    
        
        $vacations_table = VacationTable::get();

        $antiquity = Carbon::parse($Staff->hired_date)->age;     

        $year = Carbon::now()->format('Y');
        $current = Carbon::now()->format('Y-').Carbon::parse($Staff->hired_date)->format('m-d');
        $last = Carbon::parse($current)->subYear(1)->format('Y-m-d');
       

        $available_vacations =  Carbon::parse($last)->diffInYears(Carbon::now());
        if(!$available_vacations){
            $year = Carbon::now()->subYear(1)->format('Y');
            $current = Carbon::now()->subYear(1)->format('Y-').Carbon::parse($Staff->hired_date)->format('m-d');
            $last = Carbon::parse($current)->subYear(1)->format('Y-m-d');

            $available_vacations =  Carbon::parse($last)->diffInYears($current);
            $vacations_table = $this->vacations_table_2022();
        }

        $total_days = 0;
        $corresponds_days = 0;

        return view('human-resources.staff.vacations',[
            'Staff' => $Staff ,
            'antiquity' => $antiquity ,            
            'vacations_table' => $vacations_table ,

            'total_days' => $total_days ,
            'corresponds_days' => $corresponds_days ,

            'available_vacations' => $available_vacations ,
            'year' => $year
        ]);
    }
     /**
     * * CREATED VACATION REQUEST
     * @desc this function create a record
     */
    public function store(Request $request)
    {
        $this->validate($request, [               
            'staff_id' => 'required|integer',
            'start_date' => 'required',
            'end_date' => 'required',
            'come_back_date' => 'required',
            'observations' => 'nullable|max:500',
        ],[
            'start_date.required' => 'La fecha de inicio es obligatoria' ,
            'end_date.required' => 'La fecha de termino es obligatoria' ,
            'come_back_date.required' => 'La fecha para presentarse es obligatoria' ,
        ]);     

        $new = new Vacation;

        $startDate = \Carbon\Carbon::parse($request->start_date)->subDays(1);
        $endDate = \Carbon\Carbon::parse($request->end_date);                                
        $diffInDays = $startDate->diffInDays($endDate);

        $new->staff_id = $request->staff_id;
        $new->status_id = 7;
        $new->user_id = $request->user()->id;
        $new->start_date = $request->start_date;
        $new->end_date = $request->end_date;
        $new->number_of_requested_days = $diffInDays;
        $new->come_back_date = $request->come_back_date;
        $new->observations = $request->observations;

        if($new->save()){
            return redirect()->back()->withSuccess('Solicitud guardada');
        }
        return redirect()->back()->withErrors(['Error' => 'Error al crear solicitud']);         
    }
    public function accepted($id){
        $Vacation = Vacation::findOrFail($id);
        $Vacation->status_id = 8;
        if($Vacation->save()){
            return redirect()->back()->withSuccess('Solicitud aprobada');
        }
        return redirect()->back()->withErrors(['Error' => 'Error al aprobar solicitud']);        
    }
    public function denied($id){
        $Vacation = Vacation::findOrFail($id);
        $Vacation->status_id = 9;
        if($Vacation->save()){
            return redirect()->back()->withSuccess('Solicitud rechazada');
        }
        return redirect()->back()->withErrors(['Error' => 'Error al aprobar solicitud']);        
    }
    public function cancel($id){
        $Vacation = Vacation::findOrFail($id);
        $Vacation->status_id = 14;
        if($Vacation->save()){
            return redirect()->back()->withSuccess('Solicitud Cancelada');
        }
        return redirect()->back()->withErrors(['Error' => 'Error al aprobar solicitud']);         
    }
    public function make_pdf($id){
        
        $data = Vacation::with('Staff')->findOrFail($id);

        $number_days_used = Vacation::where('staff_id',$data->staff->id)->where('status_id',8)->sum('number_of_requested_days');
        
        $vacations_table = VacationTable::get();

        $antiquity = Carbon::parse($data->Staff->hired_date)->age;     

        $year = Carbon::now()->format('Y');
        $current = Carbon::now()->format('Y-').Carbon::parse($data->Staff->hired_date)->format('m-d');
        $last = Carbon::parse($current)->subYear(1)->format('Y-m-d');
       

        $available_vacations =  Carbon::parse($last)->diffInYears(Carbon::now());
        if(!$available_vacations){
            $year = Carbon::now()->subYear(1)->format('Y');
            $current = Carbon::now()->subYear(1)->format('Y-').Carbon::parse($data->Staff->hired_date)->format('m-d');
            $last = Carbon::parse($current)->subYear(1)->format('Y-m-d');

            $available_vacations =  Carbon::parse($last)->diffInYears($current);
            $vacations_table = $this->vacations_table_2022();
        }

        $total_days = 0;
        $corresponds_days = 0;

        foreach($vacations_table as $key)
        {
            if($key->from === $key->to && $antiquity===$key->to && ($available_vacations)){
                $corresponds_days = $key->days;
            }                                           
            if($key->from !== $key->to && $antiquity>=$key->from && $antiquity<=$key->to && ($available_vacations)){
                $corresponds_days = $key->days;
            }   
        }
        
        
        $pdf = Pdf::loadView('pdf.human-resources.staff.vacations', [
            'data'=>$data ,
            'vacations_table'=>$vacations_table ,
            'antiquity'=>$antiquity ,
            'total_days'=>$total_days ,
            'corresponds_days'=>$corresponds_days ,
            'available_vacations'=>$available_vacations ,
            'number_days_used'=>$number_days_used ,            
        ]);
        return $pdf->stream();
    }
    /**
     * ! THIS METHOD WILL BE DEPRECATED 
     */
    public function vacations_table_2022(){
        $data = array();
        $data[0] = (object) array('label'=>'one year' ,'from'=>1 ,'to'=>1 ,'days'=>'6');
        $data[1] = (object) array('label'=>'two years' ,'from'=>2 ,'to'=>2 ,'days'=>'8');
        $data[2] = (object) array('label'=>'three years' ,'from'=>3 ,'to'=>3 ,'days'=>'10');
        $data[3] = (object) array('label'=>'four years' ,'from'=>4 ,'to'=>4 ,'days'=>'12');
        $data[4] = (object) array('label'=>'five years to nine' ,'from'=>5 ,'to'=>9 ,'days'=>'14');
        //$data[5] = (object) array('label'=>'five years to nine' ,'from'=>'9' ,'to'=>'100' ,'days'=>'14');
        return $data;
    }
}
