<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;

class AdminAproveArtisanTest extends TestCase
{
    
        use RefreshDatabase; 
    
        public function testAdminCanAproveArtisan()
        {
            $admin = User::factory()->create([
                'name'=>'Estefanie',
                'email'=>'este@fani.es',
                'password'=>'12345678',
                'is_admin'=>true,
            ]); 
    
            $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1, 'name'=>'Pepita', 'aproved'=>false]);
              
            $response = $this->actingAs($admin)
                    ->post('profiles/' . $artisan->id);
    
            $response->assertRedirect(route('adminDash'));
            $this->assertDatabaseHas('artisans', ['name'=>'Pepita', 'aproved'=>true]);
            
                    
        }
    
}