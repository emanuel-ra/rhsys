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
        $role_recruiter = Role::create(['name' => 'recruiter']);

        Permission::create(['name' => 'dashboard'])->syncRoles([$role_admin,$role_manage_rh,$role_recruiter]);

        // companies
        Permission::create(['name' => 'companies.index'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'companies.create'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'companies.update'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'companies.delete'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'companies.upload.logo'])->syncRoles([$role_admin,$role_manage_rh]);
        
         // branches
        Permission::create(['name' => 'branches.index'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'branches.create'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'branches.update'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'branches.delete'])->syncRoles([$role_admin,$role_manage_rh]);

        // jop position
        Permission::create(['name' => 'jop.position.index'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'jop.position.create'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'jop.position.update'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'jop.position.enable'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'jop.position.disabled'])->syncRoles([$role_admin,$role_manage_rh,$role_recruiter]);

        // departments
        Permission::create(['name' => 'departments.index'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'departments.create'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'departments.update'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'departments.enable'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'departments.disabled'])->syncRoles([$role_admin,$role_manage_rh,$role_recruiter]);

        Permission::create(['name' => 'users.index'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'users.create'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'users.update'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'users.delete'])->syncRoles([$role_admin,$role_manage_rh]);

        Permission::create(['name' => 'roles.index'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'roles.create'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'roles.update'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'roles.delete'])->syncRoles([$role_admin]);

        // census
        //Permission::create(['name' => 'census.index'])->syncRoles([$role_admin]);
        //Permission::create(['name' => 'census.create'])->syncRoles([$role_admin]);
        //Permission::create(['name' => 'census.update'])->syncRoles([$role_admin]);
        //Permission::create(['name' => 'census.unsubscribe'])->syncRoles([$role_admin]);
        //Permission::create(['name' => 'census.subscribe'])->syncRoles([$role_admin,$role_manage_rh,$role_recruiter]);

        // staff
        Permission::create(['name' => 'staff.index'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'staff.create'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'staff.update'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'staff.view'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'staff.unsubscribe'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'staff.pdf.contract'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'staff.pdf.personal.data'])->syncRoles([$role_admin,$role_manage_rh]);
       
        //staff job vacancy
       
        Permission::create(['name' => 'authorized.job.vacancies.index'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'authorized.job.vacancies.config'])->syncRoles([$role_admin,$role_manage_rh]);        
        Permission::create(['name' => 'authorized.job.vacancies.view'])->syncRoles([$role_admin,$role_manage_rh]);        

       
        //-------------------- RECRUITMENT ------------------------------//
        // REQUISITIONS 
        Permission::create(['name' => 'recruitment.requisitions.index'])->syncRoles([$role_admin,$role_manage_rh,$role_recruiter]);
        Permission::create(['name' => 'recruitment.requisitions.create'])->syncRoles([$role_admin,$role_manage_rh,$role_recruiter]);
        Permission::create(['name' => 'recruitment.requisitions.update'])->syncRoles([$role_admin,$role_manage_rh,$role_recruiter]);
        Permission::create(['name' => 'recruitment.requisitions.cancel'])->syncRoles([$role_admin,$role_manage_rh,$role_recruiter]);
        Permission::create(['name' => 'recruitment.requisitions.complete'])->syncRoles([$role_admin,$role_manage_rh,$role_recruiter]);
        
        // CANDIDATES
        Permission::create(['name' => 'recruitment.candidates.index'])->syncRoles([$role_admin,$role_manage_rh,$role_recruiter]);
        Permission::create(['name' => 'recruitment.candidates.create'])->syncRoles([$role_admin,$role_manage_rh,$role_recruiter]);
        Permission::create(['name' => 'recruitment.candidates.update'])->syncRoles([$role_admin,$role_manage_rh,$role_recruiter]);
        Permission::create(['name' => 'recruitment.candidates.tracing'])->syncRoles([$role_admin,$role_manage_rh,$role_recruiter]);
        
        //INTERVIEW APPOINTMENT
        Permission::create(['name' => 'interview.appointment.index'])->syncRoles([$role_admin,$role_manage_rh,$role_recruiter]);
        Permission::create(['name' => 'interview.appointment.create'])->syncRoles([$role_admin,$role_manage_rh,$role_recruiter]);
        Permission::create(['name' => 'interview.appointment.update'])->syncRoles([$role_admin,$role_manage_rh,$role_recruiter]);
        //-------------------- RECRUITMENT ------------------------------//
        
        // REPORT         
        Permission::create(['name' => 'reports.census.index'])->syncRoles([$role_admin,$role_manage_rh]);
        Permission::create(['name' => 'reports.recruitment.interview.index'])->syncRoles([$role_admin,$role_manage_rh]);
    }
}
