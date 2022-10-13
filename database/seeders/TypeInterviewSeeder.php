<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeInterview;
class TypeInterviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeInterview::create(['name'=>'Presencial']);
        TypeInterview::create(['name'=>'Llamada']);
        TypeInterview::create(['name'=>'Video llamada']);
    }
}
