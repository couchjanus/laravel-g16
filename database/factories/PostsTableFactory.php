<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use App\Enums\PostEnumStatusType;

$factory->define(Post::class, function (Faker $faker) {
    $categoriesIds = \DB::table('categories')->pluck('id');
    $usersIds = \DB::table('users')->pluck('id');
    return [
        'title' => $faker->sentence(),
        'content' => $faker->paragraph(20),
        'status' => $faker->randomElement($array = PostEnumStatusType::getValues()),
        'votes' => $faker->randomDigit(),
        'category_id' => $faker->randomElement($array = $categoriesIds), 
        'user_id' =>  $faker->randomElement($array = $usersIds),
    ];
});
