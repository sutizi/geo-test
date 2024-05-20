<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Gender::factory(16)->create();
        \App\Models\Skill::factory(16)->create();
        \App\Models\Tournament::factory(16)->create();
        \App\Models\Player::factory()->create([
             'name' => 'Test User',
         ]);
    }
}
