<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JopPosition;
use App\Models\Department;
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
        $lorem = '';
        $record = JopPosition::create(['department_id'=>9,'name'=>'AFANADOR','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>2,'name'=>'AUXILIAR SISTEMAS','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>11,'name'=>'AUXILIAR DE CONTABILIDAD','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>12,'name'=>'AUXILIAR DE EMBARQUES','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>12,'name'=>'AUXILIAR DE ALMACÉN','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>12,'name'=>'AUXILIAR DE ALMACÉN INVENTARIOS','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>4,'name'=>'AUXILIAR DE COMPRAS','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>13,'name'=>'AUXILIAR DE DISPLAY','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>1,'name'=>'AUXILIAR DE RECURSOS HUMANOS','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>14,'name'=>'AUXILIAR DE TESORERÍA','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>15,'name'=>'CAJERA (O)','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>6,'name'=>'CALL CENTER','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>12,'name'=>'CHOFER ALMACENISTA','activities' => $lorem ]);
        
        $record = JopPosition::create(['department_id'=>7,'name'=>'COMMUNITY MANAGER ','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>7,'name'=>'CREACIÓN Y EDICIÓN DE VIDEO ','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>7,'name'=>'DISEÑADOR','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>4,'name'=>'ENCARGADA DE COMPRAS','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>12,'name'=>'ENCARGADO DE ALMACÉN','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>6,'name'=>'ENCARGADO DE CALL CENTER','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>1,'name'=>'ENCARGADO DE NOMINA Y PRESTACIONES ','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>5,'name'=>'ENCARGADO DE TIENDA ','activities' => $lorem ]);                
        $record = JopPosition::create(['department_id'=>1,'name'=>'GENERALISTA DE RECURSOS HUMANOS','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>1,'name'=>'GERENTE ADMINISTRATIVO','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>12,'name'=>'JEFE DE INVENTARIOS','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>3,'name'=>'JEFE DE SEGURIDAD','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>3,'name'=>'MONITORISTA','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>2,'name'=>'PROGRAMADOR','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>8,'name'=>'RECEPCIONISTA','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>1,'name'=>'SUB ENCARGADO','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>15,'name'=>'SUPERVISOR DE CAJERAS','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>8,'name'=>'TÉCNICO REPARADOR','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>5,'name'=>'VENDEDOR (A)','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>3,'name'=>'VIGILANTE','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>1,'name'=>'GERENTE DE RECURSOS HUMANOS','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>11,'name'=>'CONTADOR GENERAL','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>10,'name'=>'MANTENIMIENTO','activities' => $lorem ]);        
        $record = JopPosition::create(['department_id'=>5,'name'=>'ATENCION CLIENTES','activities' => $lorem ]);
        $record = JopPosition::create(['department_id'=>16,'name'=>'AUDITOR PROCESOS','activities' => $lorem ]);
        $record = JopPosition::create(['department_id'=>17,'name'=>'OTROS','activities' => $lorem ]);
       
    }
}
