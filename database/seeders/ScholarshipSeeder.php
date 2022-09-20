<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Scholarship;

class ScholarshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Scholarship::create(['name'=>'Preescolar']);
        Scholarship::create(['name'=>'Primaria']);
        Scholarship::create(['name'=>'Secundaria']);
        Scholarship::create(['name'=>'Tecnólogo']);
        Scholarship::create(['name'=>'Bachillerato General']);
        Scholarship::create(['name'=>'Bachillerato Tecnológico']);
        Scholarship::create(['name'=>'Profesional Técnico']);
        Scholarship::create(['name'=>'Capacitación para el trabajo']);
        Scholarship::create(['name'=>'Técnico Superior Universitario']);
        Scholarship::create(['name'=>'Licenciatura']);
        Scholarship::create(['name'=>'Especialización']);
        Scholarship::create(['name'=>'Maestría']);
        Scholarship::create(['name'=>'Doctorado']);
    }
}
