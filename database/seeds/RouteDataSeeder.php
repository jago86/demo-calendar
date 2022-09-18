<?php

use App\RouteData;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;

class RouteDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = file_get_contents(base_path('test-data/route_data.json'));
        $routesData = json_decode($jsonData, true)['routes_data'];

        foreach ($routesData as $routeData) {
            RouteData::create(
                Arr::except($routeData, ['updated_at', 'created_at'])
            );
        }
    }
}
