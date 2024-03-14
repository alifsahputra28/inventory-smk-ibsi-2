<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard-list',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'laboratory-room-list',
            'laboratory-room-create',
            'laboratory-room-edit',
            'laboratory-room-delete',
            'data-computer-list',
            'data-computer-create',
            'data-computer-edit',
            'data-computer-delete',
            'data-supporting-device-list',
            'data-supporting-device-create',
            'data-supporting-device-edit',
            'data-supporting-device-delete',
            'laboratory-computer-list',
            'laboratory-computer-create',
            'laboratory-computer-edit',
            'laboratory-computer-delete',
            'laboratory-supporting-device-list',
            'laboratory-supporting-device-create',
            'laboratory-supporting-device-edit',
            'laboratory-supporting-device-delete',
         ];
         
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
