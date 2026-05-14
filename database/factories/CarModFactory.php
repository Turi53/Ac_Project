<?php

namespace Database\Factories;

use App\Models\CarMod;
use App\Models\Make;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CarMod>
 */
class CarModFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model' => fake()->company(),
            'year_of_manufacture' => fake()->year(),
            'power' => fake()->numberBetween(60, 1000),
            'torque' => fake()->numberBetween(90, 1000),
            'zero_to_100' => fake()->randomFloat(1, 2, 20),
            'weight' => fake()->numberBetween(900, 2000),
            'top_speed' => fake()->numberBetween(45, 475),
            'make_id' => Make::factory(),
        ];
    }
}
