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

        // Penyuluh
        Role::create(['name' => 'Extension Worker'])->givePermissionTo(Permission::all());

        // Ketua Kelompok
        Role::create(['name' => 'Group Leader'])->givePermissionTo([
            'submit-letter-of-recommendation'
        ]);

        // Kepala Desa
        Role::create(['name' => 'Village Head'])->givePermissionTo(Permission::all());

        // Petugas Pelayanan
        Role::create(['name' => 'Service Officer'])->givePermissionTo([
            'view-station', 'create-station', 'update-station', 'delete-station',
            'view-user', 'create-user', 'update-user', 'delete-user'
        ]);

        // Kepala Dinas
        Role::create(['name' => 'Head of Department'])->givePermissionTo(Permission::all());
    }
}
