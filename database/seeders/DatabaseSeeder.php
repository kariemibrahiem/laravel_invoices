<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Spatie\Permission\Models\Role;
use Database\Seeders\PermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate();
        // User::factory(10)->create();
        $this->call([
            sectionSeeder::class,
            productSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class
        ]);
       
    
    //    assign permissions to  users
    $role = Role::findByName("user");
    $role->givePermissionTo("access invoices");
    $role->givePermissionTo("access sections");
    $role->givePermissionTo("access products");
    
    //    assign permissions to  admin
    $role = Role::findByName("admin");
    $role->givePermissionTo("access archiving");
    $role->givePermissionTo("access users");
    
    //    assign permissions to super admin
    $role = Role::findByName("super_admin");
    $role->givePermissionTo("access archiving");
    $role->givePermissionTo("access users");
    $role->givePermissionTo("access deleting");
    
    
    $user = User::where("name" ,  "user")->first();
    $user->syncRoles(["user"]);
    $user->givePermissionTo("access invoices");
    $user->givePermissionTo("access sections");
    $user->givePermissionTo("access products");
    
    $user = User::where("name" ,  "admin")->first();
    $user->syncRoles(["admin" , "user"]);
    $user->givePermissionTo("access archiving");
    $user->givePermissionTo("access users");
    
    $user = User::where("name" ,  "super_admin")->first();
    $user->syncRoles(["super_admin" , "admin" , "user"]);
    $user->givePermissionTo("access archiving");
    $user->givePermissionTo("access users");
    $user->givePermissionTo("access deleting");
    
    
    }
}
