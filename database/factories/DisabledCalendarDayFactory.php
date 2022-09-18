<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Calendar;
use App\DisabledCalendarDay;
use Faker\Generator as Faker;

$factory->define(DisabledCalendarDay::class, function (Faker $faker) {
    return [
		"calendar_id" => fn () => factory(Calendar::class)->create(),
		"day" => now()->format('Y-m-d'),
		"enabled" => true,
    ];
});
