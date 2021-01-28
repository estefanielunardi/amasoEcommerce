<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;
use App\Models\Product;


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

    public function testAdminDashboardLinksArtisanProfile()
    {
        $admin = User::factory()->create([
            'name'=>'Estefanie',
            'email'=>'este@fani.es',
            'password'=>'12345678',
            'is_admin'=>true,
        ]); 

        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1]);

        $response = $this->actingAs($admin)
                ->get('profiles/' . $artisan->slug);

        $response->assertStatus(200)
                ->assertViewIs('profileArtisan')
                ->assertViewHas('artisan')
                ->assertSee($artisan-> id);
    }

}


        


