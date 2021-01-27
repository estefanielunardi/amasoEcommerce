<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Artisan;
use App\Models\User;

class EditArtisanTest extends TestCase
{
  use RefreshDatabase;
    public function testReturnEditForm()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
        
        $response = $this->get('/artisan/edit/'. $artisan->id);

        $response->assertStatus(200);
    }

    public function testReturnViewOfEditForm()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
       

        $response = $this->get('/artisan/edit/' . $artisan->id);

        $response->assertViewIs('editArtisan')
             ->assertViewHas('artisan');
    }
}

