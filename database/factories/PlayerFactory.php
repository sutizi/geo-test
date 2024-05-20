<?php

namespace Database\Factories;

use App\Models\Gender;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName('male'),
            'gender_id' =>Gender::factory()->create()->id,
            'skill_id' => Skill::factory()->create()->id,
        ];
    }
}
