<?php

namespace Database\Factories;

use App\Models\TrackMod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TrackMod>
 */
class TrackModFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'distance' => fake()->randomFloat(1, 1, 100),
            'number_of_pits' => fake()->numberBetween(0, 100),
            'country' => fake()->country(),
            'city' => fake()->city(),
        ];
    }
}
