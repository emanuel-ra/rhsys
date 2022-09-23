<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Staff;
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
        Staff::factory(300)->create();

    }
}
