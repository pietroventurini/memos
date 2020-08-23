<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shoplist;
use Faker\Generator as Faker;

$factory->define(Memo::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($maxNbChars = 20, $indexSize = 2),
        'done' => $faker->boolean,
        'expires_at' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+10 days', $timezone = null)
    ];
});
