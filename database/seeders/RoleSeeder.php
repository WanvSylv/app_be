<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'Bibliothecaire', 'guard_name' => 'web']);
        Role::create(['name' => 'AdminGodomey', 'guard_name' => 'web']);
        Role::create(['name' => 'AdminCalavi', 'guard_name' => 'web']);
        Role::create(['name' => 'SuperAdmin', 'guard_name' => 'web']);
    }
}
