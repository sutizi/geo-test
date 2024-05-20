<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'force' => $this->faker->numberBetween(0, 100),
            'velocity' => $this->faker->numberBetween(0, 100),
            'reaction_time' => $this->faker->numberBetween(0, 100),
        ];
    }
}
