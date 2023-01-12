<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Staff;
use \App\Models\StaffLogs;
use \App\Models\StaffRotation;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\Staff::StaffFactory(50)->create();
        //factory(\App\Models\Staff::class)->count(12)->create();
        //factory(\App\Models\Staff::class)->count(12)->create();

        /*  */

        $supervisors = Staff::factory(20)->isSupervisor()->enableStatus()->has(
            StaffLogs::factory()
            ->count(1)
            ->state(function(array $attributes, Staff $staff){
                return [
                    "staff_id" => $staff->staff_id ,
                    "user_id" => $staff->user_id ,
                    "description" => ($staff->status_id==4) ? 'Alta' : 'Baja' ,
                    "data" => json_encode($staff),
                ];
            })
        )->create();
       
        foreach($supervisors as $supervisor)
        {
            $staff = Staff::factory(rand(1,10))      
            ->RelSupervisor($supervisor->id)
            ->has(
                StaffLogs::factory()
                ->count(1)
                ->state(function(array $attributes, Staff $staff){
                    return [
                        "staff_id" => $staff->staff_id ,
                        "user_id" => $staff->user_id ,
                        "description" => ($staff->status_id==4) ? 'Alta' : 'Baja' ,
                        "data" => json_encode($staff),
                    ];
                })
            )        
            ->create();        
        }        
    }   
}
