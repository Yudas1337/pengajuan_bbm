<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total = 3;
        foreach (Role::all() as $role) {
            foreach (User::factory()->count($total)->create() as $user) {
                $user->assignRole($role);
            }
        }
    }
}
