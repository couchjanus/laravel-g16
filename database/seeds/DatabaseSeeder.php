<?php

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
        \DB::table('users')->truncate();
        \DB::table('posts')->truncate();
        \DB::table('categories')->truncate();
        $this->call([
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            PostsTableSeeder::class,
        ]);
    }
}
