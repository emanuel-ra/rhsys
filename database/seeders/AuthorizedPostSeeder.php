<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JopPosition;
use App\Models\AuthorizedPost;
use App\Models\branch;

class AuthorizedPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches = branch::get();
        $JopPositions = JopPosition::get();
        foreach($branches as $branch)
        {
            foreach($JopPositions as $JopPosition)
            {               
                
                    AuthorizedPost::create([
                        'company_id' =>$branch->company_id ,
                        'branch_id' =>$branch->id ,
                        'department_id' =>$JopPosition->department_id ,
                        'jop_position_id' =>$JopPosition->id ,
                        'quantity' => rand(1,10) ,
                    ]);
              
            }            
        }        
    }
}
