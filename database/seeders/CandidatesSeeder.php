<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\Candidate;

class CandidatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Candidate::factory(15)->create();
    }
}
