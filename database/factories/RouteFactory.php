<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Route;
use Faker\Generator as Faker;

$factory->define(Route::class, function (Faker $faker) {
    $code = $faker->bothify('?###??##');
    return [
        "external_id" => null,
		"invitation_code" => $code,
		"title" => "Ruta - {$code} - " . $faker->city,
		"start_timestamp" => now()->format('Y-m-d H:i:s'),
		"end_timestamp" => now()->addHours(5)->format('Y-m-d H:i:s'),
    ];
});
