<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Supplier;
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
        Post::truncate();
        // \App\Models\User::factory(10)->create();
        //Supplier::factory(3)->create();
       // Category::factory(3)->create();
          Post::factory(3)->create();
    }
}
