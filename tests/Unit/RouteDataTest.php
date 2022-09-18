<?php

namespace Tests\Unit;

use App\RouteData;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RouteDataTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_retreive_only_off_frequency_days()
    {
        $routeData = factory(RouteData::class)->create([
            "mon" => 1,
            "tue" => 1,
            "wed" => 0,
            "thu" => 1,
            "fri" => 1,
            "sat" => 0,
            "sun" => 0,
        ]);

        $this->assertEquals(['wednesday', 'saturday', 'sunday'], $routeData->offFrequencyDays());
    }
}
