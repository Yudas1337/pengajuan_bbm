<?php

namespace Database\Seeders;

use App\Models\Station;
use App\Models\User;
use Faker\Provider\Uuid;
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
        $i = 0;
        $username = ['petugas', 'penyuluh', 'ketua', 'dinas', 'spbu'];
        foreach (Role::all() as $role) {
            $user = User::create([
                'id' => Uuid::uuid(),
                'station_id' => Station::all()->random()->id,
                'name' => fake()->name(),
                'username' => $username[$i],
                'email' => fake()->safeEmail(),
                'district_id' => 352501,
                'village_id' => 3525012001,
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => str_random(10),
            ]);
            $user->assignRole($role);
            $i++;
        }
    }
}
