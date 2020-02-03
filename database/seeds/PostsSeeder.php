<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postsData = array(
            array('title' => 'Post 1', 'content' => 'Few months ago, we found ridiculously cheap plane tickets for Boston and off we went. It was our first visit to the city and, believe it or not, Stockholm in February was more pleasant than Boston in March. It probably has a lot to do with the fact that we arrived completely unprepared. That I, in my converse and thin jacket, did not end up with pneumonia is honestly not even fair', 'category_id' => 1),
            array('title' => 'Post 2', 'content' => 'Etiam porta sem malesuada magna mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.', 'category_id' => 2),
            array('title' => 'Post 3', 'content' => 'Aenean lacinia bibendum nulla sed consectetur. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.', 'category_id' => 3),
        );
        
        // Удаляем предыдущие данные
        DB::table('posts')->delete();
        foreach ($postsData as $post) {
            DB::table('posts')->insert([
                'title' => $post['title'],
                'category_id' => $post['category_id'],
                'content' => $post['content'],
            ]);
        }
    }
}
