<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name"=>"user",
            "email"=>"user@gmail.com",
            "password"=>"123456789"
        ]);
        User::create([
            "name"=>"admin",
            "email"=>"admin@gmail.com",
            "password"=>"123456789"
        ]);
        User::create([
            "name"=>"super_admin",
            "email"=>"super_admin@gmail.com",
            "password"=>"123456789"
        ]);
    }
}
