<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\Requisitions;

class RequisitionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Requisitions::factory(10)->create();
    }
}
