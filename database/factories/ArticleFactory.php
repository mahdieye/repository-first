<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Article::class, function (Faker $faker) {
    return [
        'name' => $faker-> name,
        'status' => $faker->numberBetween(0,1),
        'description' => $faker->paragraph,
        'slug' => $faker->slug,
        'image'  => $faker->image('',200,200),

        'user_id' => factory( App\User::class),

    ];
});
