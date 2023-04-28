<?php

namespace App\Http\Controllers\HumanResources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\JopPosition;
use App\Models\Department;
use App\Models\AuthorizedPost;

class AuthotizedJopVacancyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:authorized.job.vacancies.index|authorized.job.vacancies.create|authorized.job.vacancies.update|authorized.job.vacancies.view']);
    }   
    public function index(Request $request){
        $branches = Branch::where('enable',1)->paginate(20);

        return view('human-resources.auth-jop-vacancy.app',['branches'=>$branches]);
    }
    public function config($company_id,$branch_id){

        $branch = Branch::with('company')->find($branch_id);
        $JopPosition = JopPosition::where('enable',1)->get();
        $authorizedpost = AuthorizedPost::where('company_id',$company_id)->where('branch_id',$branch_id)->get();

        if(!$branch){abort(404);}
        if(!$JopPosition){abort(404);}

        //return $authorizedpost;

        return view('human-resources.auth-jop-vacancy.config',[
            'branch'=>$branch ,
            'JopPosition'=>$JopPosition ,
            'company_id'=>$company_id ,
            'branch_id'=>$branch_id ,
            'authorizedpost'=>$authorizedpost ,
        ]);
    }
    public function store(Request $request){

        $this->validate($request, [               
            'company_id' => 'required' ,         
            'branch_id' => 'required' ,
        ]);


        AuthorizedPost::where('company_id', $request->company_id)->where('branch_id', $request->branch_id)->delete();

        foreach($request->jop_position as $id => $qty)
        {
            $record = new AuthorizedPost;
            $record->company_id = $request->company_id;
            $record->branch_id = $request->branch_id;
            $record->jop_position_id = $id;
            $record->quantity = $qty;
            $record->save();
        }
   
        //return $request;

        return redirect()->route('authorized.job.vacancies.config',['company_id'=>$request->company_id,'branch_id'=>$request->branch_id]);
        
    }
    
}
