<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// database/seeders/RolesAndPermissionsSeeder.php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'comptable']);

        // Create permissions
        Permission::create(['name' => 'create-client']);
        Permission::create(['name' => 'read-client']);
        Permission::create(['name' => 'update-client']);
        Permission::create(['name' => 'delete-client']);

        // Assign permissions to roles
        Role::findByName('superadmin')->givePermissionTo(Permission::all());
        Role::findByName('admin')->givePermissionTo(['create-client', 'read-client', 'update-client']);
        Role::findByName('comptable')->givePermissionTo(['read-client']);
    }
}
