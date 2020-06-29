<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'description' => $faker->paragraph,
        'publication_date' => $faker->dateTimeBetween('-6 months', 'now'),
        'category_id' => 1,
        'user_id' => 1
    ];
});
