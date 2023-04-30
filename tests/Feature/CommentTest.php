<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_logged_in_user_can_comment_on_post()
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

        $response = $this->post('/comments', [
            'post_id' => $post->id,
            'comment' => 'This is a test comment.'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('comments', [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'comment' => 'This is a test comment.'
        ]);
    }
}
