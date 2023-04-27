<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            // system
            RoleSeeder::class,        
            UserSeeder::class,
            CompanySeeder::class ,
            JopPositionSeeder::class ,
            DepartmentSeeder::class ,
            ScholarshipSeeder::class ,
            CountrySeeder::class ,
            StateSeeder::class ,
            StatusSeeder::class ,
            MariatialStatusSeeder::class ,   
            ReasonsToLeaveWorkSeeder::class ,            
            StaffRotationSeeder::class ,            
            CandidateSourceSeeder::class ,
            TypeInterviewSeeder::class ,
            TypeOfContractSeeder::class ,
            VacationTableSeeder::class ,

            AuthorizedPostSeeder::class , // Default one for all branches and jop positions
            
            // testing 
            //StaffSeeder::class ,            
            //RequisitionsSeeder::class ,
            //CandidatesSeeder::class ,
            //InterviewsSeeder::class ,

        ]);
    }
}
