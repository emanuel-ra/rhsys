<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VacationTable;

class VacationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VacationTable::create(['label'=>'one year','from' => 1 , 'to' => 1 , 'days' => 12 , ]);
        VacationTable::create(['label'=>'two years','from' => 2 , 'to' => 2 , 'days' => 14 , ]);
        VacationTable::create(['label'=>'three years','from' => 3 , 'to' => 3 , 'days' => 16 , ]);
        VacationTable::create(['label'=>'four years','from' => 4 , 'to' => 4 , 'days' => 18 , ]);
        VacationTable::create(['label'=>'five years','from' => 5 , 'to' => 5 , 'days' => 20 , ]);
        VacationTable::create(['label'=>'six years','from' => 6 , 'to' => 10 , 'days' => 22 , ]);
        VacationTable::create(['label'=>'eleven to fifteen years','from' => 11 , 'to' => 15 , 'days' => 24 , ]);
        VacationTable::create(['label'=>'sixteen to twenty years','from' => 16 , 'to' => 20 , 'days' => 26 , ]);
        VacationTable::create(['label'=>'twenty-one to twenty-five years','from' => 21 , 'to' => 25 , 'days' => 28 , ]);
        VacationTable::create(['label'=>'twenty-six	to thirty years','from' => 26 , 'to' => 30 , 'days' => 30 , ]);
        VacationTable::create(['label'=>'thirty-one to thirty-six years','from' => 31 , 'to' => 36 , 'days' => 32 , ]);

    }
}
