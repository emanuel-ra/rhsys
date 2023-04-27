<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\Candidate;
use \App\Models\Interview;
use App\Models\TypeInterview;
use App\Models\User;
use Faker\Factory as Faker;

class InterviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        $Candidates = Candidate::with('Requisitions')->get();
        foreach($Candidates as $key)
        {
            Interview::create([
                "commentaries" => $this->faker->text(50) , 
                "observations" => $this->faker->text(50) , 
                "candidate_id" => $key->id , 
                "status_id" => 7 , 
                "branch_id" => $key->requisitions->branch_id , 
                "type_interview_id" => TypeInterview::all()->random()->id , 
                "user_id" => User::all()->random()->id ,
                //"user_interviewer_id" => $user_interviewer_id , 
                //"attendance" => $attendance , 
                //"reschedule" => $reschedule , 
                //"reschedule_id" => $reschedule_id , 
                //"reschedule_date" => $reschedule_date , 
                "interview_date" => \Carbon\Carbon::today()->addDays(rand(0, 30)) , 
            ]);
        }
    }
}
