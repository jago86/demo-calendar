<?php

namespace App\Business;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DayDatesBetween
{
    protected $days;

    protected $from;

    protected $to;

    /**
     * @param array $days   Eg. ['monday', 'friday']
     * @param Carbon $from
     * @param Carbon $to
     */
    public function __construct(array $days, Carbon $from, Carbon $to)
    {
        $this->days = $days;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     *
     * @return \Traversable
     */
    public function get()
    {
        return CarbonPeriod::between($this->from, $this->to)
            ->filter(fn (Carbon $date) => !empty(array_filter(
                $this->days,
                fn ($day) => $date->isDayOfWeek($day)
            )))
            ->map(fn ($date) => $date->format('Y-m-d'));
    }
}
