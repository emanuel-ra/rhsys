<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Emanuel Ramirez" ,
            'email' => "programador@massivehome.com.mx" ,
            'email_verified_at' => now() ,
            'password' => '$2y$10$CbHqO.a9HsT3c6fQk.2J/ODorUbvSHUzEAWTTeCTfwfpS9lC1MsPG' , //admin23*
            'remember_token' => Str::random(10) ,
        ])->assignRole('admin');
        
        /*
        
        User::create([
            'name' => "Juan RH",
            'email' => "gerencia.rh@massivehome.com.mx",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', W// password
            'remember_token' => Str::random(10),
        ])->assignRole('manager');
        
        User::create([
            'name' => "Diana RH",
            'email' => "rh@massivehome.com.mx",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('recruiter');
        
        User::create([a
            'name' => "Karla",
            'email' => "rh2@massivehome.com.mx",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('recruiter');
        
        User::create([
            'name' => "Sonia",
            'email' => "rh3@massivehome.com.mx",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('recruiter');

        */
       
    }
}
