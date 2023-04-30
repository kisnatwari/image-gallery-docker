<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_logged_in_user_can_create_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $post = Post::factory()->create([
            'user_id' => $user->id,
            'title' => 'Test Post',
            'description' => 'This is a test post.',
            'price' => 9.99,
            'image_path' => 'uploads/default1.jpg'
        ]);
        $this->assertDatabaseCount('posts', 1);
    }
}
