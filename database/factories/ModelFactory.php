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

$factory->define(App\Models\Idea::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->userName(),
        'email' => $faker->email(),
        'title' => $faker->catchPhrase,
        'content' => $faker->text($maxNbChars = 950),
    ];
});

$factory->define(App\Models\Rating::class, function (Faker\Generator $faker) {
    return [
        'idea_id' => $faker->numberBetween($min = 1, $max = 100),
        'rating' => $faker->numberBetween($min = 1, $max = 5),
    ];
});

$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    return [
        'idea_id' => $faker->numberBetween($min = 1, $max = 100),
        'name' => $faker->userName(),
        'title' => $faker->catchPhrase(),
        'content' => $faker->text($maxNbChars = 850),
    ];
});
