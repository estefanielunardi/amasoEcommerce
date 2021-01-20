<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    public function testRouteIfUserIsAuth()
    {
        $this-> withoutExceptionHandling();
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('newProduct'));

        $response->assertStatus(200);
    }

    public function testReturnNewProductForm()
    {
        $this-> withoutExceptionHandling();
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('newProduct'));

        $response->assertViewIs('products.create');
    }
}
