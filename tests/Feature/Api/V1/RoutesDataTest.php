<?php

namespace Tests\Feature\Api\V1;

use App\Route;
use App\Calendar;
use App\RouteData;
use Tests\TestCase;
use App\Reservation;
use App\DisabledCalendarDay;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutesDataTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_off_frequency_days()
    {
        $this->withoutExceptionHandling();
        factory(RouteData::class)->create([
            'route_id' => factory(Route::class)->create(['id' => 99])->id,
            "date_init" => "2020-01-01 00:00:00",
		    "date_finish" => "2020-12-31 00:00:00",
            "mon" => 1,
            "tue" => 1,
            "wed" => 0,
            "thu" => 1,
            "fri" => 1,
            "sat" => 0,
            "sun" => 0,
        ]);

        $response = $this->get('/api/v1/route-schedule?date_init=2020-01-01&date_finish=2020-01-31&route_id=99')
            ->assertStatus(200);

        $response->assertJson([
            'off_frequency_dates' => [
                '2020-01-01',
                '2020-01-04',
                '2020-01-05',
                '2020-01-08',
                '2020-01-11',
                '2020-01-12',
                '2020-01-15',
                '2020-01-18',
                '2020-01-19',
                '2020-01-22',
                '2020-01-25',
                '2020-01-26',
                '2020-01-29',
            ],
        ]);
    }

    /** @test */
    public function get_only_off_frequency_days_on_route_data_range()
    {
        $this->withoutExceptionHandling();
        factory(RouteData::class)->create([
            'route_id' => factory(Route::class)->create(['id' => 99])->id,
            "date_init" => "2020-01-10 00:00:00",
            "date_finish" => "2020-12-20 00:00:00",
            "mon" => 1,
            "tue" => 1,
            "wed" => 0,
            "thu" => 1,
            "fri" => 1,
            "sat" => 0,
            "sun" => 0,
        ]);

        $response = $this->get('/api/v1/route-schedule?date_init=2020-01-01&date_finish=2020-01-31&route_id=99')
        ->assertStatus(200);

        $response->assertJson([
            'off_frequency_dates' => [
                '2020-01-11',
                '2020-01-12',
                '2020-01-15',
                '2020-01-18',
                '2020-01-19',
            ],
        ]);
    }

    /** @test */
    public function can_get_disabled_dates()
    {
        $this->withoutExceptionHandling();
        factory(RouteData::class)->create([
            'route_id' => factory(Route::class)->create(['id' => 99])->id,
            'calendar_id' => factory(Calendar::class)->create(['id' => 2])->id,
            "date_init" => "2020-01-01 00:00:00",
            "date_finish" => "2020-12-31 00:00:00",
        ]);
        factory(DisabledCalendarDay::class)->create([
            'calendar_id' => 2, 'day' => '2020-01-05',
        ]);
        factory(DisabledCalendarDay::class)->create([
            'calendar_id' => 2, 'day' => '2020-01-16',
        ]);
        factory(DisabledCalendarDay::class)->create([
            'calendar_id' => 2, 'day' => '2020-01-27',
        ]);

        $response = $this->get('/api/v1/route-schedule?date_init=2020-01-01&date_finish=2020-01-31&route_id=99')
            ->assertStatus(200);

        $response->assertJson([
            'disabled_dates' => [
                '2020-01-05',
                '2020-01-16',
                '2020-01-27',
            ],
        ]);
    }

    /** @test */
    public function get_only_disabled_dates_on_route_data_range()
    {
        $this->withoutExceptionHandling();
        factory(RouteData::class)->create([
            'route_id' => factory(Route::class)->create(['id' => 99])->id,
            'calendar_id' => factory(Calendar::class)->create(['id' => 2])->id,
            "date_init" => "2020-01-10 00:00:00",
            "date_finish" => "2020-12-31 00:00:00",
        ]);
        factory(DisabledCalendarDay::class)->create([
            'calendar_id' => 2, 'day' => '2020-01-05',
        ]);
        factory(DisabledCalendarDay::class)->create([
            'calendar_id' => 2, 'day' => '2020-01-16',
        ]);
        factory(DisabledCalendarDay::class)->create([
            'calendar_id' => 2, 'day' => '2020-01-27',
        ]);

        $response = $this->get('/api/v1/route-schedule?date_init=2020-01-01&date_finish=2020-01-31&route_id=99')
        ->assertStatus(200);

        $response->assertJson([
            'disabled_dates' => [
                '2020-01-16',
                '2020-01-27',
            ],
        ]);
    }

    /** @test */
    public function can_get_reserved_dates()
    {
        $this->withoutExceptionHandling();
        factory(RouteData::class)->create([
            'route_id' => factory(Route::class)->create(['id' => 99])->id,
            "date_init" => "2020-01-01 00:00:00",
            "date_finish" => "2020-12-31 00:00:00",
        ]);
        factory(Reservation::class)->create([
            'route_id' => 99,
            'reservation_start' => '2020-01-17',
            'reservation_end' => '2020-01-17',
        ]);
        factory(Reservation::class)->create([
            'route_id' => 99,
            'reservation_start' => '2020-01-24',
            'reservation_end' => '2020-01-24',
        ]);

        $response = $this->get('/api/v1/route-schedule?date_init=2020-01-01&date_finish=2020-01-31&route_id=99')
            ->assertStatus(200);

        $response->assertJson([
            'reserved_dates' => [
                '2020-01-17',
                '2020-01-24',
            ],
        ]);
    }

    /** @test */
    public function get_only_reserved_dates_on_route_data_range()
    {
        $this->withoutExceptionHandling();
        factory(RouteData::class)->create([
            'route_id' => factory(Route::class)->create(['id' => 99])->id,
            "date_init" => "2020-01-01 00:00:00",
            "date_finish" => "2020-12-31 00:00:00",
        ]);
        factory(Reservation::class)->create([
            'route_id' => 99,
            'reservation_start' => '2020-01-17',
            'reservation_end' => '2020-01-17',
        ]);
        factory(Reservation::class)->create([
            'route_id' => 99,
            'reservation_start' => '2020-01-24',
            'reservation_end' => '2020-01-24',
        ]);
        factory(Reservation::class)->create([
            'route_id' => 99,
            'reservation_start' => '2020-01-31',
            'reservation_end' => '2020-01-31',
        ]);

        $response = $this->get('/api/v1/route-schedule?date_init=2020-01-20&date_finish=2020-01-31&route_id=99')
        ->assertStatus(200);

        $response->assertJson([
            'reserved_dates' => [
                '2020-01-24',
                '2020-01-31',
            ],
        ]);
    }
}
