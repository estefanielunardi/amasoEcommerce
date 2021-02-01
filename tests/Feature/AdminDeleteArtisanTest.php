<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;
use App\Models\Product;


class AdminDeleteArtisanTest extends TestCase
{
    use RefreshDatabase; 
    public function testAdminCanDeleteAnArtisan()
    {
        $admin = User::factory()->create([
            'name'=>'Estefanie',
            'email'=>'este@fani.es',
            'password'=>'12345678',
            'is_admin'=>true,
        ]); 

        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1, 'name'=>'Pepita']);
          
        $response = $this->actingAs($admin)
                ->delete('profiles/' . $artisan->id);

        $response->assertRedirect('/');
        $this->assertDatabaseCount('artisans', 0);
        $this->assertDatabaseMissing('artisans', ['name'=>'Pepita']);
                
    }
}




        


