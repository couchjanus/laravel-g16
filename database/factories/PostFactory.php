<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use App\Enums\PostEnumStatusType;
use Cviebrock\EloquentSluggable\Services\SlugService;

$factory->define(Post::class, function (Faker $faker) {
    $categoriesIds = \DB::table('categories')->pluck('id');
    $usersIds = \DB::table('users')->pluck('id');
    $title = $faker->sentence();
    return [
        'title' => $title,
        'slug' => SlugService::createSlug(App\Post::class, 'slug', $title),
        'content' => $faker->paragraph(20),
        'status' => $faker->randomElement($array = PostEnumStatusType::getValues()),
        'votes' => $faker->randomDigit(),
        'category_id' => $faker->randomElement($array = $categoriesIds), 
        'user_id' =>  $faker->randomElement($array = $usersIds),
    ];
});
