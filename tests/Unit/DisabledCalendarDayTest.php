<?php

namespace Tests\Unit;

use App\DisabledCalendarDay;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DisabledCalendarDayTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_filter_enabled_days()
    {
        factory(DisabledCalendarDay::class)->create([
            'day' => '2020-01-08',
            'enabled' => true,
        ]);
        factory(DisabledCalendarDay::class)->create([
            'day' => '2020-01-14',
            'enabled' => false,
        ]);
        factory(DisabledCalendarDay::class)->create([
            'day' => '2020-01-20',
            'enabled' => true,
        ]);

        $enabledDays = DisabledCalendarDay::enabled()->get();
        $this->assertCount(2, $enabledDays);
        $this->assertEquals('2020-01-08', $enabledDays->first()->day->format('Y-m-d'));
        $this->assertEquals('2020-01-20', $enabledDays->last()->day->format('Y-m-d'));

    }
}
