<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Artisan;

class GetArtisanTest extends TestCase
{
    use RefreshDatabase; 
    public function testRouteArtisanProfile()
    {
        $artisan = Artisan::factory()->create(); 

        $this->withoutExceptionHandling();
        $response = $this->get('artisan/' . $artisan->id);

        $response->assertStatus(200);
    }
}
