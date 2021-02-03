<?php

namespace Tests\Feature\Artisan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ArtisanOrdersTest extends TestCase
{
    use RefreshDatabase;
    public function testRoute()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true]));
        
        $response = $this->get(route('orders'));

        $response->assertStatus(200);
    }

    public function testReturnOrdersView()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true]));
        
        $response = $this->get(route('orders'));

        $response->assertviewIs('artisanOrders');
    }
}
