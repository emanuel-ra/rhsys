<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Branch;
use App\Models\Company;
use App\Models\JopPosition;
use App\Models\Staff;
use App\Models\Department;
use App\Models\User;

class RequisitionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $company_id =  Company::all()->random()->id;
        $branch_id = Branch::where('company_id',$company_id)->get()->random()->id;
        $department_id = Department::all()->random()->id;
        $jop_position_id = JopPosition::where('department_id',$company_id)->get()->random()->id;
        $supervisor_id = Staff::where('supervisor',1)->get()->random()->id;

        $dt = $this->faker->dateTimeBetween($startDate = '-30 days', $endDate = 'now');
        $request_date = $dt->format("Y-m-d"); 

        return [            
            "company_id" => $company_id , 
            "branch_id" => $branch_id , 
            "jop_position_id" => $jop_position_id , 
            "department_id" => $department_id , 
            "user_id" => User::all()->random()->id , 
            //"cancelation_user_id" => $cancelation_user_id , 
            "supervisor_id" => $supervisor_id , 
            "status_id" => 1 , 
            "request_quantity" => 1 , 
            //"hired_quantity" => $hired_quantity , 
            "request_date" => $request_date , 
            //"closed_date" => $closed_date , 
            //"cancel_date" => $cancel_date , 
            "commentaries" => $this->faker->text(100) , 
            //"cancelation_reason" => $cancelation_reason ,             
        ];
    }
}
