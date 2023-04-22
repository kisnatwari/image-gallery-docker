<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class CommentsTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        $max_user_id = User::max('id');
        $max_post_id = Post::max('id');

        for ($i = 0; $i < 40; $i++) {
            Comment::create([
                'user_id' => $faker->numberBetween(1, $max_user_id),
                'post_id' => $faker->numberBetween(1, $max_post_id),
                'comment' => $faker->sentence,
            ]);
        }
    }
}
