<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conference>
 */
class ConferenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startsAt = now()->add('6 months');
        $endsAt = $startsAt->clone()->add('3 days');
        $cfpStartsAt = $startsAt->clone()->sub('4 months');
        $cfpEndsAt = $cfpStartsAt->clone()->add('2 months');

        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'location' => fake()->city() . ', ' . fake()->country(),
            'url' => fake()->url(),
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'cfp_starts_at' => $cfpStartsAt,
            'cfp_ends_at' => $cfpEndsAt,
        ];
    }
}
