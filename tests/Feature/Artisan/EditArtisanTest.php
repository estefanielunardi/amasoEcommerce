<?php

namespace Tests\Feature\Artisan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Artisan;
use App\Models\User;

class EditArtisanTest extends TestCase
{
  use RefreshDatabase;

  private Artisan $artisan;

  protected function setUp(): void
  {
    parent::setUp();
    $this->actingAs(User::factory()->create(['id' => 1, 'isArtisan' => true]));
    $this->artisan = Artisan::factory()->create(['user_id' => 1, 'id' => 1]);
  }
  public function testReturnEditForm()
  {
    $response = $this->get('/artisan/edit/' . $this->artisan->id);

    $response->assertStatus(200);
  }

  public function testReturnViewOfEditForm()
  {
    $response = $this->get('/artisan/edit/' . $this->artisan->id);

    $response->assertViewIs('artisan.editArtisan')
      ->assertViewHas('artisan');
  }
}
