<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RouteData extends Model
{
    protected $casts = [
        'mon' => 'boolean',
        'tue' => 'boolean',
        'wed' => 'boolean',
        'thu' => 'boolean',
        'fri' => 'boolean',
        'sat' => 'boolean',
        'sun' => 'boolean',
    ];

    protected $dates = [
        'date_init',
        'date_finish',
    ];

    public function offFrequencyDays()
    {
        return array_keys(array_filter([
            'monday' => !$this->mon,
            'tuesday' => !$this->tue,
            'wednesday' => !$this->wed,
            'thursday' => !$this->thu,
            'friday' => !$this->fri,
            'saturday' => !$this->sat,
            'sunday' => !$this->sun,
        ]));
    }
}
