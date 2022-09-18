<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Route;
use App\UserPlan;
use App\Reservation;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    return [
		"user_plan_id" => fn () => factory(UserPlan::class)->create(),
		"route_id" => fn () => factory(Route::class)->create(),
		"track_id" => null,
		"reservation_start" => now()->format('Y-m-d'),
		"reservation_end" => now()->format('Y-m-d'),
		"route_stop_origin_id" => rand(1, 999),
		"route_stop_destination_id" => rand(1, 999),
    ];
});
