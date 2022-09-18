<?php

use Illuminate\Support\Arr;
use App\DisabledCalendarDay;
use Illuminate\Database\Seeder;

class DisabledCalendarDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = file_get_contents(base_path('test-data/calendar_days_disabled.json'));
        $days = json_decode($jsonData, true)['calendar_days_disabled'];

        foreach ($days as $day) {
            DisabledCalendarDay::create(
                Arr::except($day, ['updated_at', 'created_at'])
            );
        }

        DisabledCalendarDay::create([
            "calendar_id" => 2,
            "day" => now()->startOfMonth()->addDays(7),
            "enabled" => 1,
        ]);
        DisabledCalendarDay::create([
            "calendar_id" => 2,
            "day" => now()->startOfMonth()->addDays(20),
            "enabled" => 1,
        ]);

        DisabledCalendarDay::create([
            "calendar_id" => 2,
            "day" => now()->subMonth()->startOfMonth()->addDays(9),
            "enabled" => 1,
        ]);
        DisabledCalendarDay::create([
            "calendar_id" => 2,
            "day" => now()->subMonth()->startOfMonth()->addDays(24),
            "enabled" => 1,
        ]);

        DisabledCalendarDay::create([
            "calendar_id" => 2,
            "day" => now()->startOfMonth()->addDays(3)->addMonth(),
            "enabled" => 1,
        ]);
        DisabledCalendarDay::create([
            "calendar_id" => 2,
            "day" => now()->startOfMonth()->addDays(13)->addMonth(),
            "enabled" => 1,
        ]);
    }
}
