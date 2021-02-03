<?php

namespace Tests\Feature\Artisan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Artisan;
use App\Models\User;

class UpdateArtisanTest extends TestCase
{
    use RefreshDatabase;

    private Artisan $artisan;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['isArtisan' => true, 'id' => 1]));
        $this->artisan = Artisan::factory()->create(['user_id' => 1, 'id' => 1, 'name' => 'Maria', 'image' => null]);
    }

    public function testRouteIfUserIsAuth()
    {
        $this->artisan->name = 'Mary';

        $response = $this->put(route('updateArtisan', $this->artisan), $this->artisan->toArray());

        $response->assertRedirect('artisan/mary');
    }

    public function testDBHasBeenUpdate()
    {
        $this->artisan->name = 'Mary';

        $this->put(route('updateArtisan', $this->artisan), $this->artisan->toArray());
        $this->assertDatabaseHas('artisans', ['name' => 'Mary']);
    }
}
