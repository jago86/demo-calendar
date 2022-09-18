<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CalendarSeeder::class);
        $this->call(DisabledCalendarDaySeeder::class);
        $this->call(UserPlanSeeder::class);
        $this->call(RouteSeeder::class);
        $this->call(RouteDataSeeder::class);
        $this->call(ReservationSeeder::class);
    }
}
