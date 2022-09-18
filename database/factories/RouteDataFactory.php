<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Route;
use App\Calendar;
use App\RouteData;
use Faker\Generator as Faker;

$factory->define(RouteData::class, function (Faker $faker) {
    return [
		"route_id" => fn () => factory(Route::class)->create(),
		"calendar_id" => fn () => factory(Calendar::class)->create(),
		"vinculation_route" => null,
		"route_circular" => 1,
		"date_init" => now()->startOfYear(),
		"date_finish" => now()->endOfYear(),
		"mon" => 1,
		"tue" => 1,
		"wed" => 1,
		"thu" => 1,
		"fri" => 1,
		"sat" => 0,
		"sun" => 0,
    ];
});
