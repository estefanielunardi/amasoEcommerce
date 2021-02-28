<?php

namespace Tests\Feature\Comments;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;
use App\Models\Product;

class RepliesCommentProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['isArtisan' => true, 'id' => 1]);
        $this->alfredo = User::factory()->create(['name' => 'Alfredo', 'email' => 'alfredo@alfredo', 'password' => '12345678']);
        Artisan::factory()->create(['user_id' => 1, 'id' => 1]);
        Product::factory()->create(['image' => null, 'id' => 1, 'name' => 'mermelada', 'stock' => 4]);
    }
    public function testRepliesCommentProductRoute()
    {
        $this->comment();

        $this->actingAs($this->user);
        $reply = [
            "comment" => "respuesta comentario 1",
            "product_id" => "1",
            "comment_id" => "1"
        ];
        $response = $this->post(route('replyAdd'), $reply);

        $response->assertRedirect();
    }

    public function testStoreRepliesCommentProduct()
    {
        $this->comment();

        $this->actingAs($this->user);
        $reply = [
            "comment" => "respuesta comentario 1",
            "product_id" => "1",
            "comment_id" => "1"
        ];
        $this->post(route('replyAdd'), $reply);

        $this->assertDatabaseCount('comments', 2)
        ->assertDatabaseHas('comments', ['parent_id'=>1,'body'=>"respuesta comentario 1"]);
    }

    private function comment()
    {
        $this->actingAs($this->alfredo);
        $comment = [
            "comment" => "este es un comment",
            "product_id" => "1"
        ];
        $this->post(route('commentAdd'), $comment);

    }
}
