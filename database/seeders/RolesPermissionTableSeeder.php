<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin' => [
                'product-list',
                'product-create',
                'product-edit',
                'product-delete',
                'modify-access',
            ],
            'b2c-user' => [
                'purchase-list'
            ],
            'b2b-user' => [
                'purchase-list'
            ],
        ];

        foreach ($roles as $role => $permissions) {
            $newRole = Role::create(['name' => $role]);

            foreach ($permissions as $permission) {
                $newPermission = Permission::firstOrCreate(['name' => $permission]);
                $newRole->givePermissionTo($newPermission);
            }
        }

    }
}
