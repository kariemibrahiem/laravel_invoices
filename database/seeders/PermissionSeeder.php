<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            "name" => "access invoices"
        ]);
        Permission::create([
            "name" => "access products"
        ]);
        Permission::create([
            "name" => "access sections"
        ]);

        Permission::create([
            "name" => "access archiving"
        ]);
        Permission::create([
            "name" => "access users"
        ]);

        Permission::create([
            "name" => "access deleting"
        ]);
    }
}
