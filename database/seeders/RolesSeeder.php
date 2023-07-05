<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::create(['name' => 'admin']); // IT guys
        $role_standard = Role::create(['name' => 'standard']); // Receptionist
        $role_doctor = Role::create(['name' => 'doctor']); // Doctor
        //$role_patient = Role::create(['name' => 'client']); // patients

        $permission_read = Permission::create(['name' => 'read']);
        $permission_edit = Permission::create(['name' => 'edit']);
        $permission_write = Permission::create(['name' => 'write']);
        $permission_delete = Permission::create(['name' => 'delete']);

        $permissions_admin = [$permission_read, $permission_edit, $permission_write, $permission_delete];

        $role_admin->syncPermissions($permissions_admin);
        $role_standard->givePermissionTo([$permission_read, $permission_edit]);
        $role_doctor->givePermissionTo([$permission_read, $permission_edit, $permission_write]);
        //$role_patient->givePermissionTo($permission_read);
    }
}
