<?php

namespace Database\Factories;

use App\Models\CarMod;
use App\Models\Mod;
use App\Models\Author;
use App\Models\TrackMod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Mod>
 */
class ModFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $modableType = fake()->randomElement([
            CarMod::class,
            TrackMod::class,
        ]);

        return [
            'description' => fake()->paragraph(6),
            'download_link' => fake()->url(),
            'is_premium' => fake()->boolean(30),
            'author_id' => Author::factory(),
            'published_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
            'modable_type' => $modableType,
            'modable_id' => function(array  $attributes) {
                return $attributes['modable_type']::factory()->create()->id;
            },
        ];
    }
}
