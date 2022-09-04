<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // group leader
        Permission::create(['name' => 'submit-letter-of-recommendation']);

        // worker

        Role::create(['name' => 'Group Leader'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'Extension Worker'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'Village Head'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'Service Officer'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'Head of Department'])->givePermissionTo(Permission::all());
    }
}
