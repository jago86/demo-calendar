<?php

namespace App\Http\Controllers\Api\V1;

use App\Route;
use App\RouteData;
use Carbon\Carbon;
use App\Reservation;
use Carbon\CarbonPeriod;
use App\DisabledCalendarDay;
use Illuminate\Http\Request;
use App\Business\DayDatesBetween;
use App\Http\Controllers\Controller;
use App\Business\RouteOffFrequencyDays;

class RouteScheduleController extends Controller
{
    public function index()
    {
        $initDate = Carbon::parse(request('date_init'));
        $finishDate = Carbon::parse(request('date_finish'));

        $routeData = RouteData::where('route_id', request('route_id'))
            // Request initDate is between routeData range?
            ->where('date_init', '<=', $initDate)
            // Request finishDate is between routeData range?
            ->orWhere('date_finish', '>=', $finishDate)
            ->first();

        $initRange = max($initDate, $routeData->date_init);
        $finishRange = max($finishDate, $routeData->date_finish);

        // Off frequency dates
        $offFrequencyDays = $routeData->offFrequencyDays();
        $offFrecuencyDates = (new DayDatesBetween($offFrequencyDays, $initRange, $finishRange))
            ->get();

        // Disabled dates
        $disabledDays = DisabledCalendarDay::enabled()
            ->where('calendar_id', $routeData->calendar_id)
            ->whereBetween('day', [$initRange, $finishRange])
            ->get();
        $disabledDates = $disabledDays
            ->map(fn ($disabledDay) => $disabledDay->day->format('Y-m-d'));

        // Reserved Dates
        $reservations = Reservation::where('route_id', request('route_id'))
            ->where(fn ($query) => $query
                ->where('reservation_start', '>=', $initDate)
                ->orWhere('reservation_end', '<=', $finishDate)
            )->get();
        $reservedDates = CarbonPeriod::between($initRange, $finishRange)
            ->filter(fn (Carbon $date) => $reservations->filter(fn ($reservation) => $date->isBetween($reservation->reservation_start, $reservation->reservation_end))->isNotEmpty())
            ->map(fn ($date) => $date->format('Y-m-d'));


        return [
            'off_frequency_dates' => iterator_to_array($offFrecuencyDates),
            'disabled_dates' => iterator_to_array($disabledDates),
            'reserved_dates' => iterator_to_array($reservedDates),
        ];

    }
}
