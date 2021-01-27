<?php

namespace Tests\Feature\Artisan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Artisan;
use App\Models\User;

class DeleteArtisanTest extends TestCase
{
    use RefreshDatabase;
    public function testDeleteArtisanProfile()
    {
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        Artisan::factory()->create(['user_id'=>1, 'id'=>1, 'name'=>'Pepita']);
        $response = $this->delete('/artisan/Pepita');

        $response->assertRedirect('/');
        $this->assertDatabaseCount('artisans', 0);
        $this->assertDatabaseMissing('artisans', ['name'=>'Pepita']);
    }
    
}
