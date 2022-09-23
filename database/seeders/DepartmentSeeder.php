<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create(['name'=>'RECURSOS HUMANOS']);
        Department::create(['name'=>'SISTEMAS']);
        Department::create(['name'=>'SEGURIDAD']);
        Department::create(['name'=>'COMPRAS']);
        Department::create(['name'=>'VENTAS']);
        Department::create(['name'=>'CALL CENTER']);
        Department::create(['name'=>'DISEÑO']);
        Department::create(['name'=>'SOPORTE TÉCNICO']);
        Department::create(['name'=>'LIMPIEZA']);
        Department::create(['name'=>'MANTENIMIENTO']);
        Department::create(['name'=>'CONTABILIDAD']);
        Department::create(['name'=>'ALMACÉN']);
        Department::create(['name'=>'DISPLAY']);
        Department::create(['name'=>'TESORERÍA']);
        Department::create(['name'=>'CAJAS']);        
    }
}
