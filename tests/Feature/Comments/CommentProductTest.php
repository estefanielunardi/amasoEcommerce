<?php

namespace Tests\Feature\Comments;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Artisan;


class CommentProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['isArtisan' => true, 'id' => 1]);
        $this->alfredo = User::factory()->create(['name' => 'Alfredo', 'email' => 'alfredo@alfredo', 'password' => '12345678']);
        $this->artisan = Artisan::factory()->create(['user_id' => 1, 'id' => 1]);
        $this->product1 = Product::factory()->create(['image' => null, 'id' => 1, 'name' => 'mermelada', 'stock' => 4]);
    }
    public function testCommentProductRoute()
    {
        $this->actingAs($this->alfredo);
        $comment = [ "comment" => "este es un comment",
                    "product_id" => "1"];
        $response = $this->post(route('commentAdd'), $comment);

        $response->assertRedirect();
    }
    public function testStoreCommentProduct()
    {
        $this->actingAs($this->alfredo);
        $comment = [ "comment" => "este es un comment",
                    "product_id" => "1"];
        $this->post(route('commentAdd'), $comment);

        $this->assertDatabaseCount('comments', 1)
        ->assertDatabaseHas('comments', ['body'=>'este es un comment']);
    }
}
