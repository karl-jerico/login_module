<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addPermission = Permission::create(['name' => 'add']);
        $updatePermission = Permission::create(['name' => 'update']);
        $deletePermission = Permission::create(['name' => 'delete']);
        $viewPermission = Permission::create(['name' => 'view']);
        
        Role::create(['name' => 'superadmin'])->syncPermissions([$addPermission, $updatePermission, $deletePermission, $viewPermission]);
        Role::create(['name' => 'admin'])->syncPermissions([$addPermission, $updatePermission, $viewPermission]);
        Role::create(['name' => 'user']);
    }
}
