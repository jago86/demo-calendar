<?php

use App\Route;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = file_get_contents(base_path('test-data/routes.json'));
        $routes = json_decode($jsonData, true)['routes'];

        foreach ($routes as $route) {
            Route::create(
                Arr::except($route, ['updated_at', 'created_at'])
            );
        }
    }
}
