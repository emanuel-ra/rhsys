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
        $company = Company::create([
            'name' => "LINKBITS COMERCIO ELECTRÓNICO",
            'business_name' => "LINKBITS COMERCIO ELECTRÓNICO SA DE CV",
            'address' =>'Ramon Corona #148',
            'zip_code' => '44100',
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
            'business_name' => "LINKBITS COMERCIO ELECTRÓNICO SA DE CV",
            'address' =>'Ramon Corona #148',
            'zip_code' => '44100',
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
