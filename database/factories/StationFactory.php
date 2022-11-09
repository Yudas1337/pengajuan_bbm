<?php

namespace Database\Factories;

use App\Models\Station;
use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends Factory<Station>
 */
class StationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => Uuid::uuid(),
            'name' => fake()->name(),
            'number' => fake()->unique()->phoneNumber(),
            'address' => fake()->address(),
            'pic_name' => fake()->domainName(),
            'pic_phone' => fake()->unique()->phoneNumber(),
            'type' => Arr::random(['spbu', 'spbn'])
        ];
    }
}
