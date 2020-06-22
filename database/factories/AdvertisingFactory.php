<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Advertising;
use Faker\Generator as Faker;

$factory->define(Advertising::class, function (Faker $faker) {
    return [
        'title'       => $faker->text(35),
        'description' => $faker->text(200),
        'user_id'     => 1,
    ];
});
