<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class AdminDashboardTest extends TestCase
{
    use RefreshDatabase; 
    public function testAdminDashboardRoute()
    {
        $admin = User::factory()->create([
            'name'=>'Estefanie',
            'email'=>'este@fani.es',
            'password'=>'12345678',
            'is_admin'=>true,
        ]); 

        $response = $this->actingAs($admin)
                ->get('/admin');

        $response->assertStatus(200)
                ->assertViewIs('adminDashboard')
                ->assertViewHas('artisanList');
    }

}


        


