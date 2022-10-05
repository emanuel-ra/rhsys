<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Branch;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $company = Company::create([
            'name' => "LINKBITS COMERCIO ELECTRÓNICO",
            'business_name' => "LINKBITS COMERCIO ELECTRÓNICO SA DE CV",
            'address' =>'Calle Ramon Corona #148, Guadalajara centro entre avenida Juarez y calle López Cotilla C.P. 44100 Guadalajara
            Jalisco, México',
            'zip_code' => '44100',
            'legal_representative' => $faker->name('male')      ,
            'public_deed' => $faker->text($maxNbChars = 200)  ,
            'rfc' => 'LBC1905098F2' ,
            'enable' => 1 ,
        ]);

        Branch::create([
            'name' => "Massive Home",
            'address' => "",
            'zip_code' =>'44100',
            'company_id' =>  $company->id ,
            'enable' => 1 ,
        ]);

        Branch::create([
            'name' => "Mariano Otero",
            'address' => "",
            'zip_code' =>'44100',
            'company_id' =>  $company->id ,
            'enable' => 1 ,
        ]);

        $company = Company::create([
            'name' => "Rincón de la Salud",
            'business_name' => "El Rincon de la salud SA de CV",
            'address' =>'Calle Dionisio Rodriguez #226, San Juan de Dios entre calle Vicente Guerrero y Calle José Fernando Abascal Souza. C.P. 44360 Guadalajara Jalisco, México',
            'zip_code' => '44100',
            'legal_representative' => $faker->name('male')      ,
            'public_deed' => $faker->text($maxNbChars = 200)  ,
            'rfc' => 'RSA191014EL1' ,
            'enable' => 1 ,
        ]);
        Branch::create([
            'name' => "Dionisio",
            'address' => "",
            'zip_code' =>'44100',
            'company_id' =>  $company->id ,
            'enable' => 1 ,
        ]);
        Branch::create([
            'name' => "Cabañas",
            'address' => "",
            'zip_code' =>'44100',
            'company_id' =>  $company->id ,
            'enable' => 1 ,
        ]);

    }
}
