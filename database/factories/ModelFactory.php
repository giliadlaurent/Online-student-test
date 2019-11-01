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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'access_level' => 1,
    ];
});

$factory->define(App\Group::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company
    ];
});

$factory->define(App\Test::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(3, true),
        'question_count' => 6,
        'question_count_to_fail' => 2,
        'time_limit' => 3600
    ];
});

$factory->defineAs(App\Question::class, "single", function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(6, true),
        'question' => $faker->paragraph(3, true),
        'question_type' => "radio",
        'correct_answers' => 1,
        'multiple_answers_question' => 0,
    ];
});

$factory->defineAs(App\Question::class, "double", function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(6, true),
        'question' => $faker->paragraph(3, true),
        'question_type' => "checkbox",
        'correct_answers' => 2,
        'multiple_answers_question' => 1,
    ];
});

$factory->define(App\Option::class, function (Faker\Generator $faker) {
    return [
        'option' => $faker->sentence(4, true),
        'correct_answer' => 0,
    ];
});