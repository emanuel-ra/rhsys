<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\CandidateSource;
use App\Models\Requisitions;
use App\Models\Status;
use Illuminate\Support\Str;
use File;

class CandidatesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:recruitment.candidates.index|recruitment.candidates.create|recruitment.candidates.update']);

        $path = public_path('cv');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   

        $query = Candidate::query();

        $query = $query->where('status_id','!=',2);    
        
        if($request->status_id>0){
            $query = $query->Where('status_id', $request->status_id);
        }

        if($request->source_id>0){
            $query = $query->Where('sources_id', $request->source_id);
        }

        if($request->keyWords!==''){
            $query = $query
                ->whereRaw('concat(name," ",mobile_phone," ",email) like ?','%'.$request->keyWords.'%');
                //->orWhere('mobile_phone','like','%'.$request->keyWords.'%')
                //->orWhere('email','like','%'.$request->keyWords.'%');
        }

        // $branches = Branch::select('id','name')->where('enable',1)->get();
        // $departments = Department::select('id','name')->where('enable',1)->get();
        // $jop_positions = JopPosition::select('id','name')->where('enable',1)->get();
        $status = Status::select('id','name')->whereIn('id',array(1,10))->where('enable',1)->get();
        $sources = CandidateSource::select('id','name')->where('enable',1)->get();

        $query->with('CandidateSource');
        $query->with('Requisitions');
        
        // $query->with('Company');
        // $query->with('Branch');
        // $query->with('Supervisor');
        // $query->with('Status');
        
        $query->orderByDesc('id');
        
        $data = $query->paginate(50); 
        
        return view('recruitment.candidates.app',[
            'data' => $data ,

            'status' => $status ,
            'sources' => $sources ,
            
            'status_id' => $request->status_id ,
            'source_id' => $request->source_id ,
            'keyWords' => $request->keyWords ,
        ]);
    }
    public function getCharts(Request $request){

        $start_date  = new \Carbon\Carbon('first day of this month');
        $ended_date  = new \Carbon\Carbon('last day of this month');
        
        if(isset($request->start_date)){
            $start_date  = \Carbon\Carbon::parse($request->start_date);
           
        }
        if(isset($request->ended_date)){
            $ended_date = \Carbon\Carbon::parse("$request->ended_date 23:59:59");
        }
        
        $pie_candidates_hired = Candidate::selectRaw('is_hired, count(*) data')
        ->where('status_id',1)
        ->whereBetween('created_at', [$start_date, $ended_date])
        ->groupBy('is_hired')
        ->orderBy('is_hired', 'asc')
        ->get();

        $pie_candidates_accepted = Candidate::selectRaw('is_accepted, count(*) data')
        ->where('status_id',1)
        ->whereBetween('created_at', [$start_date, $ended_date])
        ->groupBy('is_accepted')
        ->orderBy('is_accepted', 'asc')
        ->get();

        $pie_candidates_sources = Candidate::selectRaw('candidate_sources.name label, count(candidates.id) data')
                ->join('candidate_sources', 'candidates.sources_id' ,'candidate_sources.id')
                ->where('candidates.status_id',1)
                ->whereBetween('candidates.created_at', [$start_date, $ended_date])
                ->groupBy('candidates.sources_id')
                ->get();
            
        $bar_candidates_users = Candidate::selectRaw('users.name label, count(candidates.user_id) data')
            ->join('users', 'candidates.user_id' ,'users.id')
            ->where('candidates.status_id',1)
            ->whereBetween('candidates.created_at', [$start_date, $ended_date])
            ->groupBy('candidates.user_id')
            ->get();
                
        //return $bar_candidates_users;

        return view('recruitment.candidates.charts',[
            'pie_candidates_accepted'=>$pie_candidates_accepted ,
            'pie_candidates_hired'=>$pie_candidates_hired ,
            'pie_candidates_sources'=>$pie_candidates_sources ,
            'bar_candidates_users'=>$bar_candidates_users ,

            'start_date' => $start_date ,
            'ended_date' => $ended_date ,
        ]);
    }
    public function create(){      
        $CandidateSource = CandidateSource::select('id','name')->where('enable',1)->get();
        $Requisitions = Requisitions::select('id','jop_position_id','branch_id')->where('status_id',1)->with('Position')->with('Branch')->get();
        
        return view('recruitment.candidates.register',[
            'CandidateSource' => $CandidateSource ,
            'Requisitions' => $Requisitions ,
        ]);
    }
    public function edit($id){

        $Candidate = Candidate::find($id);
        $CandidateSource = CandidateSource::select('id','name')->where('enable',1)->get();
        $Requisitions = Requisitions::select('id','jop_position_id','branch_id')->where('status_id',1)->with('Position')->with('Branch')->get();
        
        return view('recruitment.candidates.edit',[
            'Candidate' => $Candidate ,
            'CandidateSource' => $CandidateSource ,
            'Requisitions' => $Requisitions ,
        ]);
    }
    public function tracing($id){
        $Candidate = Candidate::with('CandidateSource')->with('Requisitions')->with('Requisitions')->find($id);
        return view('recruitment.candidates.tracing',[
            'Candidate' => $Candidate 
        ]);

    }
    public function store(Request $request)
    {     
        $this->validate($request, [               
                'name' => 'required|max:255',         
                'email' => ['required_without:mobile_phone','max:255'] ,
                'mobile_phone' => ['required_without:email','max:255'] ,            
                'sources_id' => 'required|integer', 
                'requisition_id' => 'required|integer', 
                'cvFile' => 'nullable|mimes:pdf|max:2048', 
            ]
        );     

        $Candidate = new Candidate;

        $Candidate->name = $request->name;
        $Candidate->email = $request->email;
        $Candidate->mobile_phone = $request->mobile_phone;
        $Candidate->requisition_id = $request->requisition_id;
        $Candidate->sources_id = $request->sources_id;
        $Candidate->status_id = 1;
        $Candidate->user_id = $request->user()->id;

        if($request->hasFile('cvFile'))
        {          
            $fileName = Str::uuid().'.'.$request->cvFile->extension();  
            $request->cvFile->move(public_path('cv'), $fileName);       
            $Candidate->cv_file = $fileName ;
        }

        $Candidate->save();
     
        return redirect()->route('recruitment.candidates');    
    }
    public function update(Request $request)
    {
        $this->validate($request, [               
                'id' => 'required',
                'name' => 'required|max:255',
                'email' => ['required_without:mobile_phone','max:255'] ,
                'mobile_phone' => ['required_without:email','max:255'] ,            
                'sources_id' => 'required|integer', 
                'requisition_id' => 'required|integer', 
                //'cvFile' => 'nullable|mimes:pdf|max:2048', 
            ]
        );   


        $Candidate = Candidate::find($request->id);

        $Candidate->name = $request->name;
        $Candidate->email = $request->email;
        $Candidate->mobile_phone = $request->mobile_phone;
        $Candidate->requisition_id = $request->requisition_id;
        $Candidate->sources_id = $request->sources_id;


        if($request->hasFile('cvFile'))
        {          
            $fileName = Str::uuid().'.'.$request->cvFile->extension();  
            $request->cvFile->move(public_path('cv'), $fileName);       
            $Candidate->cv_file = $fileName ;
        }
        //$Candidate->status_id = 1;
        //$Candidate->user_id = $request->user()->id;        
        $Candidate->save();

        return redirect()->route('recruitment.candidates');    
    }

    public function update_accepted(Request $request)
    {
        $this->validate($request, [               
                'id' => 'required',
                'is_accepted' => 'required|in:1,2',
                'accepted_commentaries' => 'nullable|max:500'
            ]
        );   
        
        $Candidate = Candidate::find($request->id);
        $Candidate->is_accepted = $request->is_accepted;        
        $Candidate->accepted_date = \Carbon\Carbon::now();
        $Candidate->accepted_commentaries = trim($request->accepted_commentaries); 
        $Candidate->save();

        return redirect()->back()->withSuccess('Información guardada correctamente');
    }

    public function update_hired(Request $request)
    {
        $today =  \Carbon\Carbon::now()->toDateString();
        
        $this->validate($request, [               
                'id' => 'required',
                'is_hired' => 'required|in:1,2',
                'date_hired' => 'nullable|required_if:is_hired,1|date_format:Y-m-d|after_or_equal:'.$today ,
                'hired_commentaries' => 'nullable|max:500'
            ],[
                'date_hired.required_if' => 'La fecha de contratación es obligatoria si el candidato sera contratado' ,
                'date_hired.after_or_equal' => 'La fecha de contratación no debe de ser menor a la fecha actual'
            ]
        ); 
        

        $Candidate = Candidate::find($request->id);
        $Candidate->is_hired = $request->is_hired;        
        $Candidate->hired_date = $request->date_hired;        
        $Candidate->hired_commentaries = trim($request->hired_commentaries);                
        $Candidate->save();

        return redirect()->back()->withSuccess('Información guardada correctamente'); 
    }
    public function set_archive($id)
    {
        if(!$id){
            return redirect()->back()->withErrors(['Error' => 'Parámetros incorrectos']);
        }

        $Candidate = Candidate::find($id);
        $Candidate->status_id = 10;
        if($Candidate->save()){
            return redirect()->back()->withSuccess('Candidato archivado');
        }else{
            return redirect()->back()->withErrors(['Error' => 'Error al archivar archivo']);
        }

    }
    public function set_active($id){
        if(!$id){
            return redirect()->back()->withErrors(['Error' => 'Parámetros incorrectos']);
        }

        $Candidate = Candidate::find($id);
        $Candidate->status_id = 1;
        if($Candidate->save()){
            return redirect()->back()->withSuccess('Candidato Activado');
        }else{
            return redirect()->back()->withErrors(['Error' => 'Error al activar archivo']);
        }
    }
    public function delete_cv($id){
      if(!$id){
        return redirect()->back()->withErrors(['Error' => 'Parámetros incorrectos']);
      }

      $Candidate = Candidate::find($id);

      $file = public_path()."/cv/".$Candidate->cv_file;
      
      if(File::delete($file)){
        $Candidate->cv_file = null;
        $Candidate->save();
        return redirect()->back()->withSuccess(['Archivo Eliminado']);
      }
      return redirect()->back()->withErrors(['Error' => 'Error al eliminar archivo']);
    }

}
