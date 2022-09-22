<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MaritalStatus;

class MariatialStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MaritalStatus::create(['name'=>'Soltero']);
        MaritalStatus::create(['name'=>'Casado']);
        MaritalStatus::create(['name'=>'Divorciado']);
        MaritalStatus::create(['name'=>'Separación en proceso judicial']);
        MaritalStatus::create(['name'=>'Viudo']);
        MaritalStatus::create(['name'=>'Concubinato']);
    }
}
