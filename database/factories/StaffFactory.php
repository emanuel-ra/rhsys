<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
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


class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status_arr = array(4,5);
        $status_id = $status_arr[array_rand($status_arr, 1)];

        $dt = $this->faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now');
        $hired_date = $dt->format("Y-m-d"); 
        
        $dt = $this->faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now');
        $resignation_date = $dt->format("Y-m-d"); 

        $gender = $this->faker->randomElement(['Masculino', 'Femenino']);


        return [
            'name' => $this->faker->name() , 
            'code' => $this->faker->unique()->numberBetween(100, 500) ,
            'genre' => $gender ,
            'curp' => 'XEXX010101HNEXXXA4' ,
            'rfc' => 'XAXX010101000' ,
            'nss' => $this->faker->regexify('/^(\d{2})(\d{2})(\d{2})\d{5}$/') ,

            'email' => $this->faker->email() ,
            'mobile_phone' => $this->faker->phoneNumber() ,
            'address' => $this->faker->address() ,
            'suburb' => $this->faker->citySuffix() ,
            'zip_code' => $this->faker->postcode() ,
            'town' => $this->faker->cityPrefix() ,
            'city' => $this->faker->cityPrefix() ,
            'bank_account' => $this->faker->regexify('^3[47][0-9]{13}$') ,
            'company_id' =>  Company::all()->random()->id ,
            'branch_id' =>  Branch::all()->random()->id ,
            'jop_position_id' =>  JopPosition::all()->random()->id ,
            'department_id' =>  Department::all()->random()->id ,
            'scholarship_id' =>  Scholarship::all()->random()->id ,
            'maritial_status_id' => MaritalStatus::all()->random()->id ,
            'user_id' => 1 ,
            'country_id' => 151 ,
            'state_id' => State::all()->random()->id ,
            'status_id' => $status_id ,
            'socioeconomic' => rand(0,1) ,
            'hired_date' => $hired_date ,
            'born_date' => $this->faker->date() ,
            'unsubscribe_date' => ($status_id==5) ? $resignation_date : null ,
            'reason_unsubscribe_id' => ($status_id==5) ? ReasonsToLeaveWork::all()->random()->id  : 0  ,
            //'expiration_date' => $this->faker->name() ,
        ];
    }
}
