<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\BlogSeeder;
use Database\Seeders\CommentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BlogSeeder::class,
            CommentSeeder::class
        ]);
    }
}
