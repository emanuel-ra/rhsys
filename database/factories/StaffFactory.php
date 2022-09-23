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
use App\Models\StateOfACountry;
use App\Models\Status;

class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status_id = array(4,5);
        return [
            'name' => $this->faker->name() , 
            'code' => $this->faker->name() ,
            'genre' => $this->faker->name() ,
            //'curp' => $this->faker->name() ,
            //'rfc' => $this->faker->name() ,
            //'nss' => $this->faker->name() ,
            'email' => $this->faker->email() ,
            'mobile_phone' => $this->faker->phoneNumber() ,
            'address' => $this->faker->address() ,
            'suburb' => $this->faker->citySuffix() ,
            'zip_code' => $this->faker->postcode() ,
            'town' => $this->faker->cityPrefix() ,
            'city' => $this->faker->cityPrefix() ,
            //'bank_account' => $this->faker->name() ,
            'company_id' =>  Company::all()->random()->id ,
            'branch_id' =>  Branch::all()->random()->id ,
            'jop_position_id' =>  JopPosition::all()->random()->id ,
            'department_id' =>  Department::all()->random()->id ,
            'scholarship_id' =>  Scholarship::all()->random()->id ,
            'maritial_status_id' => MaritalStatus::all()->random()->id ,
            'user_id' => 1 ,
            'country_id' => 151 ,
            'state_of_a_country_id' => StateOfACountry::all()->random()->id ,
            'status_id' => $status_id[array_rand($status_id, 1)] ,
            'socioeconomic' => rand(0,1) ,
            'hired_date' => $this->faker->date() ,
            'born_date' => $this->faker->date()
            ,
            //'resignation_date' => $this->faker->name() ,
            //'expiration_date' => $this->faker->name() ,
        ];
    }
}
