<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StateOfACountry;
use App\Models\Department;

class StateOfACountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StateOfACountry::create(['code'=>'AGU', 'name' => 'Aguascalientes' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'BCN', 'name' => 'Baja California' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'BCS', 'name' => 'Baja California Sur' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'CAM', 'name' => 'Campeche' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'CHP', 'name' => 'Chiapas' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'CHH', 'name' => 'Chihuahua' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'COA', 'name' => 'Coahuila' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'COL', 'name' => 'Colima' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'CMX', 'name' => 'Ciudad de México' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'DUR', 'name' => 'Durango' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'GUA', 'name' => 'Guanajuato' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'GRO', 'name' => 'Guerrero' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'HID', 'name' => 'Hidalgo' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'JAL', 'name' => 'Jalisco' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'MEX', 'name' => 'Estado de México' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'MIC', 'name' => 'Michoacán' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'MOR', 'name' => 'Morelos' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'NAY', 'name' => 'Nayarit' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'NLE', 'name' => 'Nuevo León' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'OAX', 'name' => 'Oaxaca' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'PUE', 'name' => 'Puebla' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'QUE', 'name' => 'Querétaro' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'ROO', 'name' => 'Quintana Roo' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'SLP', 'name' => 'San Luis Potosí' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'SIN', 'name' => 'Sinaloa' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'SON', 'name' => 'Sonora' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'TAB', 'name' => 'Tabasco' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'TAM', 'name' => 'Tamaulipas' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'TLA', 'name' => 'Tlaxcala' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'VER', 'name' => 'Veracruz' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'YUC', 'name' => 'Yucatán' , 'country_id' => 151]);
        StateOfACountry::create(['code'=>'ZAC', 'name' => 'Zacatecas' , 'country_id' => 151]);


        StateOfACountry::create(['code' => 'AL', 'name' => 'Alabama' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'AK', 'name' => 'Alaska' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'AZ', 'name' => 'Arizona' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'AR', 'name' => 'Arkansas' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'CA', 'name' => 'California' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'NC', 'name' => 'Carolina del Norte' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'SC', 'name' => 'Carolina del Sur' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'CO', 'name' => 'Colorado' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'CT', 'name' => 'Connecticut' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'ND', 'name' => 'Dakota del Norte' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'SD', 'name' => 'Dakota del Sur' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'DE', 'name' => 'Delaware' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'FL', 'name' => 'Florida' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'GA', 'name' => 'Georgia' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'HI', 'name' => 'Hawái' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'ID', 'name' => 'Idaho' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'IL', 'name' => 'Illinois' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'IN', 'name' => 'Indiana' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'IA', 'name' => 'Iowa' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'KS', 'name' => 'Kansas' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'KY', 'name' => 'Kentucky' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'LA', 'name' => 'Luisiana' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'ME', 'name' => 'Maine' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'MD', 'name' => 'Maryland' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'MA', 'name' => 'Massachusetts' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'MI', 'name' => 'Míchigan' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'MN', 'name' => 'Minnesota' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'MS', 'name' => 'Misisipi' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'MO', 'name' => 'Misuri' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'MT', 'name' => 'Montana' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'NE', 'name' => 'Nebraska' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'NV', 'name' => 'Nevada' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'NJ', 'name' => 'Nueva Jersey' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'NY', 'name' => 'Nueva York' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'NH', 'name' => 'Nuevo Hampshire' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'NM', 'name' => 'Nuevo México' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'OH', 'name' => 'Ohio' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'OK', 'name' => 'Oklahoma' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'OR', 'name' => 'Oregón' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'PA', 'name' => 'Pensilvania' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'RI', 'name' => 'Rhode Island' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'TN', 'name' => 'Tennessee' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'TX', 'name' => 'Texas' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'UT', 'name' => 'Utah' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'VT', 'name' => 'Vermont' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'VA', 'name' => 'Virginia' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'WV', 'name' => 'Virginia Occidental' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'WA', 'name' => 'Washington' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'WI', 'name' => 'Wisconsin' , 'country_id' => 66 ]);
        StateOfACountry::create(['code' => 'WY', 'name' => 'Wyoming' , 'country_id' => 66 ]);

    }
}
