<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use App\Enums\PostEnumStatusType;
use Cviebrock\EloquentSluggable\Services\SlugService;

$factory->define(Post::class, function (Faker $faker) {
    $usersIds = \DB::table('users')->pluck('id');
    $title = $faker->sentence();
    return [
        'title' => $title,
        'slug' => SlugService::createSlug(App\Post::class, 'slug', $title),
        'content' => $faker->paragraph(20),
        'status' => $faker->randomElement($array = PostEnumStatusType::getValues()),
        'votes' => $faker->randomDigit(),
        'user_id' =>  $faker->randomElement($array = $usersIds),
        "cover_path" => asset("storage/covers/cover.png"),
        "visits" => 0
    ];
});
