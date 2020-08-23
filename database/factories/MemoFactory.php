<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Memo;
use Faker\Generator as Faker;

$factory->define(Memo::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($maxNbChars = 30, $indexSize = 2),
        'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'done' => $faker->boolean,
        'expires_at' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+10 days', $timezone = null)
    ];
});
