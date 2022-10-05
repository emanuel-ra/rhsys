<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create(['code'=>'AGU', 'name' => 'Aguascalientes' , 'country_id' => 2]);
        State::create(['code'=>'BCN', 'name' => 'Baja California' , 'country_id' => 2]);
        State::create(['code'=>'BCS', 'name' => 'Baja California Sur' , 'country_id' => 2]);
        State::create(['code'=>'CAM', 'name' => 'Campeche' , 'country_id' => 2]);
        State::create(['code'=>'CHP', 'name' => 'Chiapas' , 'country_id' => 2]);
        State::create(['code'=>'CHH', 'name' => 'Chihuahua' , 'country_id' => 2]);
        State::create(['code'=>'COA', 'name' => 'Coahuila' , 'country_id' => 2]);
        State::create(['code'=>'COL', 'name' => 'Colima' , 'country_id' => 2]);
        State::create(['code'=>'CMX', 'name' => 'Ciudad de México' , 'country_id' => 2]);
        State::create(['code'=>'DUR', 'name' => 'Durango' , 'country_id' => 2]);
        State::create(['code'=>'GUA', 'name' => 'Guanajuato' , 'country_id' => 2]);
        State::create(['code'=>'GRO', 'name' => 'Guerrero' , 'country_id' => 2]);
        State::create(['code'=>'HID', 'name' => 'Hidalgo' , 'country_id' => 2]);
        State::create(['code'=>'JAL', 'name' => 'Jalisco' , 'country_id' => 2]);
        State::create(['code'=>'MEX', 'name' => 'Estado de México' , 'country_id' => 2]);
        State::create(['code'=>'MIC', 'name' => 'Michoacán' , 'country_id' => 2]);
        State::create(['code'=>'MOR', 'name' => 'Morelos' , 'country_id' => 2]);
        State::create(['code'=>'NAY', 'name' => 'Nayarit' , 'country_id' => 2]);
        State::create(['code'=>'NLE', 'name' => 'Nuevo León' , 'country_id' => 2]);
        State::create(['code'=>'OAX', 'name' => 'Oaxaca' , 'country_id' => 2]);
        State::create(['code'=>'PUE', 'name' => 'Puebla' , 'country_id' => 2]);
        State::create(['code'=>'QUE', 'name' => 'Querétaro' , 'country_id' => 2]);
        State::create(['code'=>'ROO', 'name' => 'Quintana Roo' , 'country_id' => 2]);
        State::create(['code'=>'SLP', 'name' => 'San Luis Potosí' , 'country_id' => 2]);
        State::create(['code'=>'SIN', 'name' => 'Sinaloa' , 'country_id' => 2]);
        State::create(['code'=>'SON', 'name' => 'Sonora' , 'country_id' => 2]);
        State::create(['code'=>'TAB', 'name' => 'Tabasco' , 'country_id' => 2]);
        State::create(['code'=>'TAM', 'name' => 'Tamaulipas' , 'country_id' => 2]);
        State::create(['code'=>'TLA', 'name' => 'Tlaxcala' , 'country_id' => 2]);
        State::create(['code'=>'VER', 'name' => 'Veracruz' , 'country_id' => 2]);
        State::create(['code'=>'YUC', 'name' => 'Yucatán' , 'country_id' => 2]);
        State::create(['code'=>'ZAC', 'name' => 'Zacatecas' , 'country_id' => 2]);


        State::create(['code' => 'AL', 'name' => 'Alabama' , 'country_id' => 1 ]);
        State::create(['code' => 'AK', 'name' => 'Alaska' , 'country_id' => 1 ]);
        State::create(['code' => 'AZ', 'name' => 'Arizona' , 'country_id' => 1 ]);
        State::create(['code' => 'AR', 'name' => 'Arkansas' , 'country_id' => 1 ]);
        State::create(['code' => 'CA', 'name' => 'California' , 'country_id' => 1 ]);
        State::create(['code' => 'NC', 'name' => 'Carolina del Norte' , 'country_id' => 1 ]);
        State::create(['code' => 'SC', 'name' => 'Carolina del Sur' , 'country_id' => 1 ]);
        State::create(['code' => 'CO', 'name' => 'Colorado' , 'country_id' => 1 ]);
        State::create(['code' => 'CT', 'name' => 'Connecticut' , 'country_id' => 1 ]);
        State::create(['code' => 'ND', 'name' => 'Dakota del Norte' , 'country_id' => 1 ]);
        State::create(['code' => 'SD', 'name' => 'Dakota del Sur' , 'country_id' => 1 ]);
        State::create(['code' => 'DE', 'name' => 'Delaware' , 'country_id' => 1 ]);
        State::create(['code' => 'FL', 'name' => 'Florida' , 'country_id' => 1 ]);
        State::create(['code' => 'GA', 'name' => 'Georgia' , 'country_id' => 1 ]);
        State::create(['code' => 'HI', 'name' => 'Hawái' , 'country_id' => 1 ]);
        State::create(['code' => 'ID', 'name' => 'Idaho' , 'country_id' => 1 ]);
        State::create(['code' => 'IL', 'name' => 'Illinois' , 'country_id' => 1 ]);
        State::create(['code' => 'IN', 'name' => 'Indiana' , 'country_id' => 1 ]);
        State::create(['code' => 'IA', 'name' => 'Iowa' , 'country_id' => 1 ]);
        State::create(['code' => 'KS', 'name' => 'Kansas' , 'country_id' => 1 ]);
        State::create(['code' => 'KY', 'name' => 'Kentucky' , 'country_id' => 1 ]);
        State::create(['code' => 'LA', 'name' => 'Luisiana' , 'country_id' => 1 ]);
        State::create(['code' => 'ME', 'name' => 'Maine' , 'country_id' => 1 ]);
        State::create(['code' => 'MD', 'name' => 'Maryland' , 'country_id' => 1 ]);
        State::create(['code' => 'MA', 'name' => 'Massachusetts' , 'country_id' => 1 ]);
        State::create(['code' => 'MI', 'name' => 'Míchigan' , 'country_id' => 1 ]);
        State::create(['code' => 'MN', 'name' => 'Minnesota' , 'country_id' => 1 ]);
        State::create(['code' => 'MS', 'name' => 'Misisipi' , 'country_id' => 1 ]);
        State::create(['code' => 'MO', 'name' => 'Misuri' , 'country_id' => 1 ]);
        State::create(['code' => 'MT', 'name' => 'Montana' , 'country_id' => 1 ]);
        State::create(['code' => 'NE', 'name' => 'Nebraska' , 'country_id' => 1 ]);
        State::create(['code' => 'NV', 'name' => 'Nevada' , 'country_id' => 1 ]);
        State::create(['code' => 'NJ', 'name' => 'Nueva Jersey' , 'country_id' => 1 ]);
        State::create(['code' => 'NY', 'name' => 'Nueva York' , 'country_id' => 1 ]);
        State::create(['code' => 'NH', 'name' => 'Nuevo Hampshire' , 'country_id' => 1 ]);
        State::create(['code' => 'NM', 'name' => 'Nuevo México' , 'country_id' => 1 ]);
        State::create(['code' => 'OH', 'name' => 'Ohio' , 'country_id' => 1 ]);
        State::create(['code' => 'OK', 'name' => 'Oklahoma' , 'country_id' => 1 ]);
        State::create(['code' => 'OR', 'name' => 'Oregón' , 'country_id' => 1 ]);
        State::create(['code' => 'PA', 'name' => 'Pensilvania' , 'country_id' => 1 ]);
        State::create(['code' => 'RI', 'name' => 'Rhode Island' , 'country_id' => 1 ]);
        State::create(['code' => 'TN', 'name' => 'Tennessee' , 'country_id' => 1 ]);
        State::create(['code' => 'TX', 'name' => 'Texas' , 'country_id' => 1 ]);
        State::create(['code' => 'UT', 'name' => 'Utah' , 'country_id' => 1 ]);
        State::create(['code' => 'VT', 'name' => 'Vermont' , 'country_id' => 1 ]);
        State::create(['code' => 'VA', 'name' => 'Virginia' , 'country_id' => 1 ]);
        State::create(['code' => 'WV', 'name' => 'Virginia Occidental' , 'country_id' => 1 ]);
        State::create(['code' => 'WA', 'name' => 'Washington' , 'country_id' => 1 ]);
        State::create(['code' => 'WI', 'name' => 'Wisconsin' , 'country_id' => 1 ]);
        State::create(['code' => 'WY', 'name' => 'Wyoming' , 'country_id' => 1 ]);
    }
}
