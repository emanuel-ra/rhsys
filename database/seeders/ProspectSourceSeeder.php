<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProspectSource;

class ProspectSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProspectSource::create(['name'=>'COMPUTRABAJO']);
        ProspectSource::create(['name'=>'FACEBOOK']);
        ProspectSource::create(['name'=>'INDEED']);
        ProspectSource::create(['name'=>'RECOMENDADO']);
        ProspectSource::create(['name'=>'OCC']);
        ProspectSource::create(['name'=>'LINKEDIN']);
    }
}
