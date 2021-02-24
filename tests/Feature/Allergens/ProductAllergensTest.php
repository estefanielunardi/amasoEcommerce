<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductAllergensTest extends TestCase
{
    
    public function test_product_has_allergens()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
