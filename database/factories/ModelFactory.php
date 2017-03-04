<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Entities\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Entities\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Entities\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Entities\Article::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'alias' => $faker->sentence,
        'description' => $faker->text,
        'short_description' => $faker->paragraph,
        'category_id' => function () {
            return factory(App\Entities\Category::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\Entities\User::class)->create()->id;
        },
        'status' => App\Entities\Article::STATUS_PUBLISHED
    ];
});
