<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Calendar;
use Faker\Generator as Faker;

$factory->define(Calendar::class, function (Faker $faker) {
    return [
        "calendar_id" => null,
		"name" => $faker->city,
    ];
});
