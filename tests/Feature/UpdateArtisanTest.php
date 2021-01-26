<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Artisan;
use App\Models\User;

class UpdateArtisanTest extends TestCase
{
    use RefreshDatabase;
    public function testRouteIfUserIsAuth()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1, 'name'=>'Maria']);
        $artisan->name = 'Mary';
               
        $response = $this->put(route('updateArtisan', $artisan) , $artisan->toArray());
        
        $response->assertRedirect('artisan/Mary');
    }

    public function testDBHasBeenUpdate()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1, 'name'=>'Maria']);
        $artisan->name = 'Mary';
    
        $response = $this->put(route('updateArtisan', $artisan) , $artisan->toArray());
        $this->assertDatabaseHas('artisans', ['name'=>'Mary']);
    
    }

}
