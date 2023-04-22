<?php

namespace App\Http\Controllers\Api\HumanResources;
use Illuminate\Database\Eloquent\ModelNotFoundException;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Department;
use App\Models\JopPosition;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Scholarship;
use App\Models\Country;
use App\Models\MaritalStatus;
use App\Models\State;
use App\Models\Status;
use App\Models\ReasonsToLeaveWork;
use App\Models\User;

use App\Models\StaffLogs;
use App\Models\StaffRotation;

class StaffController extends Controller
{
    public function store(Request $request)
    {   
        $this->validate($request, [               
            'code' => 'required|max:20|unique:staff,code,'.$request->code.',code' ,     
            //'checker_code' => 'nullable|max:20|unique:staff',         
            'name' => 'required|max:255',     
            //'email' => 'required|email|max:255',                 
            //'mobile_phone' => 'required|max:15',            

            'rfc_company' => [ 'required','max:20', 'regex:/^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$/' ],

            //'company_id' => 'required',
            //'branch_id' => 'required',
            'jop_position_id' => 'required',
            'department_id' => 'required',
            //'scholarship_id' => 'required',
          
            //'country_id' => 'nullable',
            //'state_id' => 'nullable',
            //'socioeconomic' => 'required',
            'hired_date' => 'required|max:10',
            'born_date' => 'required|max:10',
            'daily_salary' => 'required' ,
            'father_name' => 'nullable|max:255',
            'mother_name' => 'nullable|max:255',
            'spouse_name' => 'nullable|max:255',
            'chields_name' => 'nullable|max:500',
            'landline_number' => 'nullable|max:255',
            'mobile_emergency_phone' => 'nullable|max:255',
            'landline_emergency_phone' => 'nullable|max:255',

            'name_person_emergency' => 'nullable|max:255',
            'born_place' => 'nullable|max:255',

        'rfc' => [ 'nullable','max:20' /*,'regex:/^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$/'*/ ],
    'curp' => [ 'nullable','max:20'/*, 'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/' */ ],
        'nss' => [ 'nullable','max:20' ],      
            
            
            'status' => 'required|in:A,B',
            'maritial' => 'nullable:in:C,S',
        ]);  
        // 'unique:staff,rfc,'.$request->code.',code' 
        // 'unique:staff,curp,'.$request->code.',code' , 
        // 'unique:staff,nss,'.$request->code.',code'
        try{
            $Company = Company::where("rfc",$request->rfc_company)->firstOrFail();
        }catch(ModelNotFoundException  $e){
            return Response()->json([
                "message"=>"Company isn't exists" ,
            ],404);
        }
       
        try{
            $Branch = Branch::where('company_id',$Company->id)->firstOrFail();
        }catch(ModelNotFoundException  $e){
            return Response()->json([
                "message"=>"Branch isn't exists" ,
            ],404);
        }

        $working_hours = $this->defaultWorkingHours();
        
        $action = 'updated';
        try{
            $exist = Staff::where("code",$request->code)->firstOrFail();
            if($exist->id>0)
                $Staff = Staff::find($exist->id); 
        }catch(ModelNotFoundException  $e){
            $action = 'registered';
            $Staff = new Staff;    
        }

        
        

        $Staff->name = $request->name;
        $Staff->code = $request->code;
        //$Staff->checker_code = $request->checker_code;
        $Staff->genre = $request->genre;
        $Staff->curp = $request->curp;
        $Staff->rfc = $request->rfc;
        $Staff->nss = $request->nss;
        $Staff->email = $request->email;
        $Staff->mobile_phone = $request->mobile_phone;
        $Staff->address = $request->address;
        $Staff->suburb = $request->suburb;
        $Staff->zip_code = $request->zip_code;
        $Staff->town = $request->town;
        $Staff->city = $request->city;
        $Staff->bank_account = $request->bank_account;
        $Staff->company_id = $Company->id;
        $Staff->branch_id = $Branch->id;
        $Staff->jop_position_id = $request->jop_position_id;
        $Staff->department_id = $request->department_id;
        $Staff->scholarship_id = 1;
        $Staff->maritial_status_id = ($request->maritial=="C") ? 2:1;
        $Staff->country_id = 2;
        $Staff->state_id = 14;
        $Staff->socioeconomic = 0;
        $Staff->supervisor = 0;        
        $Staff->supervisor_id = 0;        
        $Staff->hired_date = $request->hired_date;
        $Staff->status_id = ($request->status == 'A') ? 4:5;
        $Staff->working_hours = json_encode($working_hours);
        $Staff->daily_salary = $request->daily_salary;
        $Staff->user_id = $request->user()->id;        

        $Staff->landline_number = $request->landline_number;
        $Staff->landline_emergency_phone = $request->landline_emergency_phone;
        $Staff->mobile_emergency_phone = $request->mobile_emergency_phone;
        $Staff->blood_type = $request->blood_type;
        $Staff->father_name = $request->father_name;
        $Staff->mother_name = $request->mother_name;
        $Staff->spouse_name = $request->spouse_name;
        $Staff->chields_name = $request->chields_name;
        $Staff->type_of_contract_id = 0;
        $Staff->name_person_emergency = $request->name_person_emergency;
        $Staff->born_place = $request->born_place;

        if($request->hired_date!='')
            $Staff->hired_date = $request->hired_date;      
        if($request->born_date!='')
            $Staff->born_date = $request->born_date;        
        if($request->expiration_date!='')
            $Staff->expiration_date = $request->expiration_date;
                    
        $Staff->save();

        $StaffLogs = new StaffLogs;
        $StaffLogs->staff_id =  $Staff->id;
        $StaffLogs->user_id =  $request->user()->id;
        $StaffLogs->description = ($action=='updated') ? 'Actualizado':'Alta';
        $StaffLogs->data = json_encode($Staff);
        $StaffLogs->save();
    
        if($Staff->save()){
            return Response()->json([
                'message' => 'Your data is '.$action.' successfully' ,
                'data' => $Staff
            ],201);
        }

        return Response()->json([
            'message' => 'Error, some thing gone wrong' ,
            'data' => []
        ],400);

    }
    private function defaultWorkingHours(){
        return [
            'monday' => [
                'enable' => true,
                'start' => '09:00' ,
                'end' => '18:30' ,
            ],
            'tuesday' => [
                'enable' => true,
                'start' => '09:00' ,
                'end' => '18:30' ,
            ],
            'wednesday' => [
                'enable' => true,
                'start' => '09:00' ,
                'end' => '18:30' ,
            ],
            'thursday' => [
                'enable' => true,
                'start' => '09:00' ,
                'end' => '18:30' ,
            ],
            'friday' => [
                'enable' => true,
                'start' => '09:00' ,
                'end' => '18:30' ,
            ],
            'saturday' => [
                'enable' => true,
                'start' => '09:00' ,
                'end' => '18:30' ,
            ],
            'sunday' => [
                'enable' => false,
                'start' => '' ,
                'end' => '' ,
            ]
        ];
    }
}
