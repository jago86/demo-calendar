<?php

namespace Tests\Feature\Api\V1;

use App\Route;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_routes()
    {
        factory(Route::class)->create([
            'title' => 'Route 1',
        ]);
        factory(Route::class)->create([
            'title' => 'Route 3',
        ]);

        $response = $this->get('api/v1/routes')
            ->assertStatus(200);

        $response->assertJson([
            [
                'title' => 'Route 1',
            ],
            [
                'title' => 'Route 3',
            ],
        ]);
    }
}
