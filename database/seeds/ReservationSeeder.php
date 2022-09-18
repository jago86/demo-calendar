<?php

use App\Reservation;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = file_get_contents(base_path('test-data/reservations.json'));
        $reservations = json_decode($jsonData, true)['reservations'];

        foreach ($reservations as $reservation) {
            Reservation::create(
                Arr::except($reservation, ['updated_at', 'created_at'])
            );
        }

        Reservation::create([
            "user_plan_id" => 52,
            "route_id" => 1,
            "track_id" => null,
            "reservation_start" => now()->startOfMonth()->addDays(5),
            "reservation_end" => now()->startOfMonth()->addDays(5),
            "route_stop_origin_id" => 597,
            "route_stop_destination_id" => 600,
        ]);

        Reservation::create([
            "user_plan_id" => 52,
            "route_id" => 1,
            "track_id" => null,
            "reservation_start" => now()->startOfMonth()->addDays(22),
            "reservation_end" => now()->startOfMonth()->addDays(22),
            "route_stop_origin_id" => 597,
            "route_stop_destination_id" => 600,
        ]);
    }
}
