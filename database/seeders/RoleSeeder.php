<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Ketua Kelompok
        Permission::create(['name' => 'submit-letter-of-recommendation']);

        // Petugas pelayanan
        Permission::create(['name' => 'view-station']);
        Permission::create(['name' => 'create-station']);
        Permission::create(['name' => 'update-station']);
        Permission::create(['name' => 'delete-station']);

        Permission::create(['name' => 'view-user']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'update-user']);
        Permission::create(['name' => 'delete-user']);
        Permission::create(['name' => 'activate-user']);
        Permission::create(['name' => 'deactivate-user']);

        // Penyuluh
        Role::create(['name' => 'Penyuluh'])->givePermissionTo(Permission::all());

        // Ketua Kelompok
        Role::create(['name' => 'Ketua Kelompok'])->givePermissionTo([
            'submit-letter-of-recommendation'
        ]);

        // Kepala Desa
        Role::create(['name' => 'Kepala Desa'])->givePermissionTo(Permission::all());

        // Petugas Pelayanan
        Role::create(['name' => 'Petugas Pelayanan'])->givePermissionTo([
            'view-station', 'create-station', 'update-station', 'delete-station',
            'view-user', 'create-user', 'update-user', 'delete-user', 'activate-user',
            'deactivate-user'
        ]);

        // Kepala Dinas
        Role::create(['name' => 'Kepala Dinas'])->givePermissionTo(Permission::all());
    }
}
