<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CandidateSource;

class CandidateSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CandidateSource::create(['name'=>'COMPUTRABAJO']);
        CandidateSource::create(['name'=>'FACEBOOK']);
        CandidateSource::create(['name'=>'INDEED']);
        CandidateSource::create(['name'=>'RECOMENDADO']);
        CandidateSource::create(['name'=>'OCC']);
        CandidateSource::create(['name'=>'LINKEDIN']);
    }
}
