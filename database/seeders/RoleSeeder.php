<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::create(['name' => 'admin']);
        $role_manage_rh = Role::create(['name' => 'manager']);
        $role_rh = Role::create(['name' => 'recruiter']);

        $dashboard = Permission::create(['name' => 'dashboard'])->syncRoles([$role_admin,$role_manage_rh,$role_rh]);

        $companies_index = Permission::create(['name' => 'companies.index'])->syncRoles([$role_admin,$role_manage_rh]);
        $companies_create = Permission::create(['name' => 'companies.create'])->syncRoles([$role_admin,$role_manage_rh]);
        $companies_update = Permission::create(['name' => 'companies.update'])->syncRoles([$role_admin,$role_manage_rh]);
        $companies_delete = Permission::create(['name' => 'companies.delete'])->syncRoles([$role_admin,$role_manage_rh]);

        $branches_index = Permission::create(['name' => 'branches.index'])->syncRoles([$role_admin,$role_manage_rh]);
        $branches_create = Permission::create(['name' => 'branches.create'])->syncRoles([$role_admin,$role_manage_rh]);
        $branches_update = Permission::create(['name' => 'branches.update'])->syncRoles([$role_admin,$role_manage_rh]);
        $branches_delete = Permission::create(['name' => 'branches.delete'])->syncRoles([$role_admin,$role_manage_rh]);

        $users_index = Permission::create(['name' => 'users.index'])->syncRoles([$role_admin,$role_manage_rh]);
        $users_create = Permission::create(['name' => 'users.create'])->syncRoles([$role_admin,$role_manage_rh]);
        $users_update = Permission::create(['name' => 'users.update'])->syncRoles([$role_admin,$role_manage_rh]);
        $users_delete = Permission::create(['name' => 'users.delete'])->syncRoles([$role_admin,$role_manage_rh]);

        $roles_index = Permission::create(['name' => 'roles.index'])->syncRoles([$role_admin]);
        $roles_create = Permission::create(['name' => 'roles.create'])->syncRoles([$role_admin]);
        $roles_update = Permission::create(['name' => 'roles.update'])->syncRoles([$role_admin]);
        $roles_delete = Permission::create(['name' => 'roles.delete'])->syncRoles([$role_admin]);

        // census
        $census_index = Permission::create(['name' => 'census.index'])->syncRoles([$role_admin]);
        $census_create = Permission::create(['name' => 'census.create'])->syncRoles([$role_admin]);
        $census_update = Permission::create(['name' => 'census.update'])->syncRoles([$role_admin]);
        $census_delete = Permission::create(['name' => 'census.unsubscribe'])->syncRoles([$role_admin]);
        $census_delete = Permission::create(['name' => 'census.subscribe'])->syncRoles([$role_admin,$role_manage_rh,$role_rh]);

        // staff
        $staff_index = Permission::create(['name' => 'staff.index'])->syncRoles([$role_admin,$role_manage_rh]);
        $staff_create = Permission::create(['name' => 'staff.create'])->syncRoles([$role_admin,$role_manage_rh]);
        $staff_update = Permission::create(['name' => 'staff.update'])->syncRoles([$role_admin,$role_manage_rh]);
        $staff_delete = Permission::create(['name' => 'staff.unsubscribe'])->syncRoles([$role_admin,$role_manage_rh]);
        $staff_delete = Permission::create(['name' => 'staff.subscribe'])->syncRoles([$role_admin,$role_manage_rh,$role_rh]);

        // jop position
        $jop_position_index = Permission::create(['name' => 'jop.position.index'])->syncRoles([$role_admin,$role_manage_rh]);
        $jop_position_create = Permission::create(['name' => 'jop.position.create'])->syncRoles([$role_admin,$role_manage_rh]);
        $jop_position_update = Permission::create(['name' => 'jop.position.update'])->syncRoles([$role_admin,$role_manage_rh]);
        $jop_position_delete = Permission::create(['name' => 'jop.position.unsubscribe'])->syncRoles([$role_admin,$role_manage_rh]);
        $jop_position_delete = Permission::create(['name' => 'jop.position.subscribe'])->syncRoles([$role_admin,$role_manage_rh,$role_rh]);

        //interview appointment
        $interview_appointment_index = Permission::create(['name' => 'interview.appointment.index'])->syncRoles([$role_admin,$role_manage_rh,$role_rh]);
        $interview_appointment_create = Permission::create(['name' => 'interview.appointment.create'])->syncRoles([$role_admin,$role_manage_rh,$role_rh]);
        $interview_appointment_update = Permission::create(['name' => 'interview.appointment.update'])->syncRoles([$role_admin,$role_manage_rh,$role_rh]);
        $interview_appointment_delete = Permission::create(['name' => 'interview.appointment.unsubscribe'])->syncRoles([$role_admin,$role_manage_rh,$role_rh]);
        $interview_appointment_delete = Permission::create(['name' => 'interview.appointment.subscribe'])->syncRoles([$role_admin,$role_manage_rh,$role_rh]);


    }
}
