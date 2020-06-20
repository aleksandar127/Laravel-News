<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'category_id' => 1,
        'text' => $faker->realText($faker->numberBetween(10, 20)),
        'user_id' => User::all()->random()->id

    ];
});
