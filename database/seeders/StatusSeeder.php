<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['name'=>'Activo']);
        Status::create(['name'=>'Eliminado']);
        Status::create(['name'=>'Bloqueado']);
        Status::create(['name'=>'Alta']);
        Status::create(['name'=>'Baja']);        
        Status::create(['name'=>'Vencido']);
        Status::create(['name'=>'Pendiente']);
        Status::create(['name'=>'Aceptado']);
        Status::create(['name'=>'Rechazado']);
        Status::create(['name'=>'Archivado']);
        Status::create(['name'=>'Stand by']);
        Status::create(['name'=>'Reagendada']);        
    }
}
