<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'user' => [
                'join_room',
                'leave_room',
                'deposit',
                'withdraw'
            ],
            'dealer' => [
                'join_room',
                'leave_room',
                'create_room',
                'delete_room',
                'start_game',
                'kick_user'
            ]
        ];

        $permissions = [
            'create_room',
            'join_room',
            'leave_room',
            'delete_room',
            'start_game',
            'create_user',
            'delete_user',
            'deposit',
            'withdraw',
            'kick_user'
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        foreach ($roles as $role => $rolePermissions) {
            $role = Role::findOrCreate($role);
            if (is_array($rolePermissions)) {
                foreach ($rolePermissions as $permission) {
                    $role->givePermissionTo($permission);
                }
            }
        }
    }
}
