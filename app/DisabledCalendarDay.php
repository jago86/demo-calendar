<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DisabledCalendarDay extends Model
{

    protected $dates = [
        'day',
    ];

    /**
     * Filter by enabled field
     *
     * @param Builder $query
     * @return void
     */
    public function scopeEnabled(Builder $query)
    {
        return $query->where('enabled', 1);
    }
}
