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
        $lorem = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab enim officia debitis aliquam quasi veritatis atque maiores neque explicabo, eius nemo inventore, illum dolorem, nihil eveniet culpa sunt excepturi provident.';
        $record = JopPosition::create(['department_id'=>9,'name'=>'AFANADOR(A)','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>9,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>2,'name'=>'AUX. DE SISTEMAS','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>2,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>11,'name'=>'AUXILIAR CONTABLE','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>11,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>12,'name'=>'AUXILIAR DE EMBARQUES','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>12,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>12,'name'=>'AUXILIAR DE ALMACÉN','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>12,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>12,'name'=>'AUXILIAR DE ALMACÉN INVENTARIOS','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>12,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>4,'name'=>'AUXILIAR DE COMPRAS','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>4,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>13,'name'=>'AUXILIAR DE DISPLAY','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>13,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>1,'name'=>'AUXILIAR DE RECURSOS HUMANOS ','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>1,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>14,'name'=>'AUXILIAR DE TESORERÍA','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>14,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>15,'name'=>'CAJERA (O)','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>15,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>6,'name'=>'CALL CENTER','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>6,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>12,'name'=>'CHOFER ALMACENISTA','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>12,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>7,'name'=>'COMMUNITY MANAGER ','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>7,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>7,'name'=>'CREACIÓN Y EDICIÓN DE VIDEO ','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>7,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>7,'name'=>'DISEÑADOR','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>7,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>4,'name'=>'ENCARGADA DE COMPRAS','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>4,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>12,'name'=>'ENCARGADO DE ALMACÉN','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>12,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>6,'name'=>'ENCARGADO DE CALL CENTER','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>6,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>1,'name'=>'ENCARGADO DE NOMINA Y PRESTACIONES ','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>1,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>5,'name'=>'ENCARGADO DE TIENDA ','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>5,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>5,'name'=>'ENCARGADO TIENDA DIONISIO','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>5,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>1,'name'=>'GENERALISTA DE RECURSOS HUMANOS','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>1,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>1,'name'=>'GERENTE ADMINISTRATIVO','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>1,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>12,'name'=>'JEFE DE INVENTARIOS','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>12,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>3,'name'=>'JEFE DE SEGURIDAD','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>3,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>3,'name'=>'MONITORISTA','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>3,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>2,'name'=>'PROGRAMADOR','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>2,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>8,'name'=>'RECEPCIONISTA','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>8,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>1,'name'=>'SUB ENCARGADO','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>1,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>15,'name'=>'SUPERVISOR DE CAJERAS','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>15,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>8,'name'=>'TÉCNICO REPARADOR','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>8,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>5,'name'=>'VENDEDOR (A)','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>5,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>3,'name'=>'VIGILANTE','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>3,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>1,'name'=>'GERENTE DE RECURSOS HUMANOS','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>1,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>11,'name'=>'CONTADOR GENERAL','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>11,'jop_position_id'=>$record->id,'quantity'=>0]);
        $record = JopPosition::create(['department_id'=>10,'name'=>'MANTENIMIENTO','activities' => $lorem ]);
        //AuthorizedPost::create(['department_id'=>10,'jop_position_id'=>$record->id,'quantity'=>0]);
    }
}
