<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JopPosition;
//use App\Models\AuthorizedPost;

class JopPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record = JopPosition::create(['department_id'=>9,'name'=>'AFANADOR(A)']);
        //AuthorizedPost::create(['department_id'=>9,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>2,'name'=>'AUX. DE SISTEMAS']);
        //AuthorizedPost::create(['department_id'=>2,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>11,'name'=>'AUXILIAR CONTABLE']);
        //AuthorizedPost::create(['department_id'=>11,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>12,'name'=>'AUXILIAR DE EMBARQUES']);
        //AuthorizedPost::create(['department_id'=>12,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>12,'name'=>'AUXILIAR DE ALMACÉN']);
        //AuthorizedPost::create(['department_id'=>12,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>12,'name'=>'AUXILIAR DE ALMACÉN INVENTARIOS']);
        //AuthorizedPost::create(['department_id'=>12,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>4,'name'=>'AUXILIAR DE COMPRAS']);
        //AuthorizedPost::create(['department_id'=>4,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>13,'name'=>'AUXILIAR DE DISPLAY']);
        //AuthorizedPost::create(['department_id'=>13,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>1,'name'=>'AUXILIAR DE RECURSOS HUMANOS ']);
        //AuthorizedPost::create(['department_id'=>1,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>14,'name'=>'AUXILIAR DE TESORERÍA']);
        //AuthorizedPost::create(['department_id'=>14,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>15,'name'=>'CAJERA (O)']);
        //AuthorizedPost::create(['department_id'=>15,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>6,'name'=>'CALL CENTER']);
        //AuthorizedPost::create(['department_id'=>6,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>12,'name'=>'CHOFER ALMACENISTA']);
        //AuthorizedPost::create(['department_id'=>12,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>7,'name'=>'COMMUNITY MANAGER ']);
        //AuthorizedPost::create(['department_id'=>7,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>7,'name'=>'CREACIÓN Y EDICIÓN DE VIDEO ']);
        //AuthorizedPost::create(['department_id'=>7,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>7,'name'=>'DISEÑADOR']);
        //AuthorizedPost::create(['department_id'=>7,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>4,'name'=>'ENCARGADA DE COMPRAS']);
        //AuthorizedPost::create(['department_id'=>4,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>12,'name'=>'ENCARGADO DE ALMACÉN']);
        //AuthorizedPost::create(['department_id'=>12,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>6,'name'=>'ENCARGADO DE CALL CENTER']);
        //AuthorizedPost::create(['department_id'=>6,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>1,'name'=>'ENCARGADO DE NOMINA Y PRESTACIONES ']);
        //AuthorizedPost::create(['department_id'=>1,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>5,'name'=>'ENCARGADO DE TIENDA ']);
        //AuthorizedPost::create(['department_id'=>5,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>5,'name'=>'ENCARGADO TIENDA DIONISIO']);
        //AuthorizedPost::create(['department_id'=>5,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>1,'name'=>'GENERALISTA DE RECURSOS HUMANOS']);
        //AuthorizedPost::create(['department_id'=>1,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>1,'name'=>'GERENTE ADMINISTRATIVO']);
        //AuthorizedPost::create(['department_id'=>1,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>12,'name'=>'JEFE DE INVENTARIOS']);
        //AuthorizedPost::create(['department_id'=>12,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>3,'name'=>'JEFE DE SEGURIDAD']);
        //AuthorizedPost::create(['department_id'=>3,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>3,'name'=>'MONITORISTA']);
        //AuthorizedPost::create(['department_id'=>3,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>2,'name'=>'PROGRAMADOR']);
        //AuthorizedPost::create(['department_id'=>2,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>8,'name'=>'RECEPCIONISTA']);
        //AuthorizedPost::create(['department_id'=>8,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>1,'name'=>'SUB ENCARGADO']);
        //AuthorizedPost::create(['department_id'=>1,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>15,'name'=>'SUPERVISOR DE CAJERAS']);
        //AuthorizedPost::create(['department_id'=>15,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>8,'name'=>'TÉCNICO REPARADOR']);
        //AuthorizedPost::create(['department_id'=>8,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>5,'name'=>'VENDEDOR (A)']);
        //AuthorizedPost::create(['department_id'=>5,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>3,'name'=>'VIGILANTE']);
        //AuthorizedPost::create(['department_id'=>3,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>1,'name'=>'GERENTE DE RECURSOS HUMANOS']);
        //AuthorizedPost::create(['department_id'=>1,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>11,'name'=>'CONTADOR GENERAL']);
        //AuthorizedPost::create(['department_id'=>11,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>10,'name'=>'MANTENIMIENTO']);
        //AuthorizedPost::create(['department_id'=>10,'jop_position_id'=>$record->id,'quantity'=>0]);
    }
}
