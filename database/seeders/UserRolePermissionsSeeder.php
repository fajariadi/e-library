<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserRolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];

        $admin = User::create(array_merge([
            'email' => 'admin@gmail.com',
            'name' => 'admin',
        ], $default_user_value));

        $anggota = User::create(array_merge([
            'email' => 'anggota@gmail.com',
            'name' => 'anggota',
        ], $default_user_value));

        $role_admin = Role::create(['name' => 'admin']);
        $role_anggota = Role::create(['name' => 'anggota']);

        $permission = Permission::create(['name' => 'read konfigurasi/roles']);
        $permission = Permission::create(['name' => 'create konfigurasi/roles']);
        $permission = Permission::create(['name' => 'update konfigurasi/roles']);
        $permission = Permission::create(['name' => 'delete konfigurasi/roles']);
        $permission = Permission::create(['name' => 'read konfigurasi']);
        $permission = Permission::create(['name' => 'read konfigurasi/permissions']);

        $role_admin->givePermissionTo('read konfigurasi/roles');
        $role_admin->givePermissionTo('read konfigurasi/permissions');
        $role_admin->givePermissionTo('create konfigurasi/roles');
        $role_admin->givePermissionTo('update konfigurasi/roles');
        $role_admin->givePermissionTo('delete konfigurasi/roles');
        $role_admin->givePermissionTo('read konfigurasi');
    }
}
