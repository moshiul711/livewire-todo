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
        \App\Models\Todo::factory(07)->create();

        // \App\Models\Todo::factory()->create([
        //     'name' => 'Test User',

        // ]);
    }
}
