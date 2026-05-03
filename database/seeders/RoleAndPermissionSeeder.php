<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'user_management_access',
            'user_management_create',
            'user_management_edit',
            'user_management_delete',
            'role_management_access',
            'permission_management_access',
            'inventory_access',
            'inventory_create',
            'inventory_edit',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // 2. Create the Admin Role and give it all permissions
        $role = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $role->givePermissionTo(Permission::all());

        Role::create(['name' => 'Approval Authority (IT)']);
        Role::create(['name' => 'Approval Authority (Non-IT)']);
    }
}
