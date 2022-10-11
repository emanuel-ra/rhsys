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
        $branch = branch::get(); 
        $JopPosition = JopPosition::get(); 
        foreach($branch as $key)
        {
            foreach($JopPosition as $key2)
            {
                AuthorizedPost::create([
                    'company_id'=> $key->company_id ,
                    'branch_id'=>$key->id ,
                    'jop_position_id'=>$key2->id ,
                    'quantity'=>rand(1,10) ,
                ]);
            }
        }
    }
}
