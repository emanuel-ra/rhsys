<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReasonsToLeaveWork;

class ReasonsToLeaveWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReasonsToLeaveWork::create(['name'=>'Salario']);
        ReasonsToLeaveWork::create(['name'=>'Exceso laboral']);
        ReasonsToLeaveWork::create(['name'=>'Ambiente laboral']);
        ReasonsToLeaveWork::create(['name'=>'Despido']);
        ReasonsToLeaveWork::create(['name'=>'Puesto temporal']);
        ReasonsToLeaveWork::create(['name'=>'Oferta de empleo']);
        ReasonsToLeaveWork::create(['name'=>'Abandono laboral']);
        ReasonsToLeaveWork::create(['name'=>'Separación voluntaria']);
        //ReasonsToLeaveWork::create(['name'=>'Otros']);        
    }
}
