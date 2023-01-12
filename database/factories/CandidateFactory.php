<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Requisitions;
use App\Models\CandidateSource;

class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name() , 
            "email" => $this->faker->email() , 
            "mobile_phone" => $this->faker->phoneNumber() , 
            "requisition_id" => Requisitions::all()->random()->id , 
            "sources_id" => CandidateSource::all()->random()->id , 
            "status_id" => 1 , 
            "user_id" => User::all()->random()->id ,
            "commentaries" => $this->faker->text(50) , 
            //"is_hired" => $is_hired , 
            //"is_accepted" => $is_accepted , 
            //"hired_date" => $hired_date , 
            //"accepted_date" => $accepted_date , 
        ];
    }
}
