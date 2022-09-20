<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JopPosition;

class JopPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JopPosition::create(['name'=>'AFANADOR(A)']);
        JopPosition::create(['name'=>'AUX. DE SISTEMAS']);
        JopPosition::create(['name'=>'AUXILIAR CONTABLE']);
        JopPosition::create(['name'=>'AUXILIAR DE  EMBARQUES']);
        JopPosition::create(['name'=>'AUXILIAR DE ALMACÉN']);
        JopPosition::create(['name'=>'AUXILIAR DE ALMACÉN INVENTARIOS']);
        JopPosition::create(['name'=>'AUXILIAR DE COMPRAS']);
        JopPosition::create(['name'=>'AUXILIAR DE DISPLAY']);
        JopPosition::create(['name'=>'AUXILIAR DE RECURSOS HUMANOS ']);
        JopPosition::create(['name'=>'AUXILIAR DE TESORERÍA']);
        JopPosition::create(['name'=>'CAJERA (O)']);
        JopPosition::create(['name'=>'CALL CENTER']);
        JopPosition::create(['name'=>'CHOFER ALMACENISTA']);
        JopPosition::create(['name'=>'COMMUNITY MANAGER ']);
        JopPosition::create(['name'=>'CREACIÓN Y EDICIÓN DE VIDEO ']);
        JopPosition::create(['name'=>'DISEÑADOR']);
        JopPosition::create(['name'=>'ENCARGADA DE COMPRAS']);
        JopPosition::create(['name'=>'ENCARGADO DE ALMACÉN']);
        JopPosition::create(['name'=>'ENCARGADO DE CALL CENTER']);
        JopPosition::create(['name'=>'ENCARGADO DE NOMINA Y PRESTACIONES ']);
        JopPosition::create(['name'=>'ENCARGADO DE TIENDA ']);
        JopPosition::create(['name'=>'ENCARGADO TIENDA DIONISIO']);
        JopPosition::create(['name'=>'GENERALISTA DE RECURSOS HUMANOS']);
        JopPosition::create(['name'=>'GERENTE ADMINISTRATIVO']);
        JopPosition::create(['name'=>'JEFE DE INVENTARIOS']);
        JopPosition::create(['name'=>'JEFE DE SEGURIDAD']);
        JopPosition::create(['name'=>'MONITORISTA']);
        JopPosition::create(['name'=>'PROGRAMADOR']);
        JopPosition::create(['name'=>'RECEPCIONISTA']);
        JopPosition::create(['name'=>'SUB ENCARGADO']);
        JopPosition::create(['name'=>'SUPERVISOR DE CAJERAS']);
        JopPosition::create(['name'=>'TÉCNICO REPARADOR']);
        JopPosition::create(['name'=>'VENDEDOR (A)']);
        JopPosition::create(['name'=>'VIGILANTE']);
        JopPosition::create(['name'=>'GERENTE DE RECURSOS HUMANOS']);
        JopPosition::create(['name'=>'CONTADOR GENERAL']);
        JopPosition::create(['name'=>'MANTENIMIENTO']);
    }
}
