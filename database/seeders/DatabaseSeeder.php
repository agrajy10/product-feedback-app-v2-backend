<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Feedback::factory(10)->create();
        Tag::factory(5)->create();
    }
}
