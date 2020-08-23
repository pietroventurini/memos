<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->realText($maxNbChars = 30, $indexSize = 2),
        'description' => $faker->realText($maxNbChars = 100, $indexSize = 2),
    ];
});
