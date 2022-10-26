<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeOfContract;

class TypeOfContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeOfContract::create(['name'=>'Tiempo Indefinido']);
        TypeOfContract::create(['name'=>'Período de Prueba']);
        TypeOfContract::create(['name'=>'Tiempo Determinado']);
        TypeOfContract::create(['name'=>'Relación de Trabajo por Temporada']);
    }
}
