<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            'manage institutes',
            'manage trades',
            'manage courses',
            'manage students',
            'manage enrollments',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Roles
        $superAdmin = Role::create(['name' => 'super_admin']);
        $instituteAdmin = Role::create(['name' => 'institute_admin']);
        $staff = Role::create(['name' => 'staff']);

        // Give all permissions to super admin
        $superAdmin->givePermissionTo(Permission::all());

        // Institute admin permissions
        $instituteAdmin->givePermissionTo([
            'manage trades',
            'manage courses',
            'manage students',
            'manage enrollments',
        ]);

        // Staff permissions
        $staff->givePermissionTo([
            'manage students',
            'manage enrollments',
        ]);
    }
}
