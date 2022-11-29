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
        Permission::create(['name' => 'view-letter-of-recommendation']);
        Permission::create(['name' => 'update-letter-of-recommendation']);
        Permission::create(['name' => 'delete-letter-of-recommendation']);
        Permission::create(['name' => 'restore-letter-of-recommendation']);
        Permission::create(['name' => 'validate-letter-of-recommendation']);

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

        Permission::create(['name' => 'view-receiver']);
        Permission::create(['name' => 'create-receiver']);
        Permission::create(['name' => 'update-receiver']);
        Permission::create(['name' => 'delete-receiver']);

        Permission::create(['name' => 'view-group']);
        Permission::create(['name' => 'create-group']);
        Permission::create(['name' => 'update-group']);
        Permission::create(['name' => 'delete-group']);

        Permission::create(['name' => 'history-transaction']);
        // Petugas SPBU
        Permission::create(['name' => 'record-transaction']);

        // Petugas Admin
        Role::create(['name' => 'Admin Tangkap'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'Admin Pembudidaya'])->givePermissionTo(Permission::all());


        // Penyuluh
        Role::create(['name' => 'Penyuluh'])->givePermissionTo([
            'submit-letter-of-recommendation', 'view-letter-of-recommendation', 'update-letter-of-recommendation',
            'delete-letter-of-recommendation', 'restore-letter-of-recommendation', 'validate-letter-of-recommendation',
            'view-group', 'create-group', 'update-group', 'delete-group'
        ]);

        // Ketua Kelompok
        Role::create(['name' => 'Ketua Kelompok'])->givePermissionTo([
            'submit-letter-of-recommendation', 'view-letter-of-recommendation', 'update-letter-of-recommendation',
            'delete-letter-of-recommendation', 'restore-letter-of-recommendation'
        ]);

        // Kepala Dinas
        Role::create(['name' => 'Kepala Dinas'])->givePermissionTo([
            'validate-letter-of-recommendation'
        ]);

        // Petugas SPBU
        Role::create(['name' => 'Petugas SPBU'])->givePermissionTo([
            'record-transaction'
        ]);
    }
}
