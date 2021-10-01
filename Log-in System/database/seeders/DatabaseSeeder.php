<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;

// use Illuminate\Database\Eloquent\Factories\Factory;
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
        User::factory()->count(10)->hasPosts(1)->create();
    }
}
