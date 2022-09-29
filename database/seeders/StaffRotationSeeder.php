<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Staff;
use \App\Models\StaffRotation;

class StaffRotationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Staff = Staff::where('status_id',5)->get();

        foreach($Staff as $staff)
        {
            StaffRotation::create([
                'staff_id' => $staff->id ,
                'supervisor_id' => $staff->supervisor_id ,
                'company_id' => $staff->company_id ,
                'branch_id' => $staff->branch_id ,
                'department_id' => $staff->department_id ,
                'jop_position_id' => $staff->jop_position_id ,
                'scholarship_id' => $staff->scholarship_id ,
            ]);
        }
    }
}
