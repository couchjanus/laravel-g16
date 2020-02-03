<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // DB::table('categories')->insert([
        //     'name' => Str::random(4),
        //     'description' => Str::random(40),
        //     'votes' => 4
        // ]);

        $categoriesData = array(
            array('name' => 'artisan', 'description' => 'Artisan Categories', 'votes' => 4),
            array('name' => 'php', 'description' => 'PHP Categories', 'votes' => 4),
            array('name' => 'laravel', 'description' => 'Laravel Categories', 'votes' => 4),
        );
        
        // Удаляем предыдущие данные
        DB::table('categories')->delete();
        foreach ($categoriesData as $cat) {
            DB::table('categories')->insert([
                'name' => $cat['name'],
                'votes' => $cat['votes'],
                'description' => $cat['description'],
            ]);
        }
    }
}
