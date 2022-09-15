<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => "LINKBITS COMERCIO ELECTRÓNICO ",
            'business_name' => "LINKBITS COMERCIO ELECTRÓNICO SA DE CV",
            'address' =>'Ramon Corona #148',
            'zip_code' => '44100',
            'enable' => 1 ,
        ]);
    }
}
