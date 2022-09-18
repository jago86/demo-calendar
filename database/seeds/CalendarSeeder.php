<?php

use App\Calendar;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;

class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = file_get_contents(base_path('test-data/calendar.json'));
        $calendars = json_decode($jsonData, true)['calendar'];

        foreach ($calendars as $calendar) {
            Calendar::create(
                Arr::except($calendar, ['updated_at', 'created_at'])
            );
        }
    }
}
