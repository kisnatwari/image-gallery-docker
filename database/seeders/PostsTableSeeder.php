<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $max_user_id = User::max('id');

        $initial_data = [];

        for ($i = 1; $i <= 8; $i++) {
            Post::create([
                'user_id' => $faker->numberBetween(1, $max_user_id),
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'price' => $faker->randomFloat(2, 10, 500),
                'image_path' => 'uploads/default' . $i . '.jpg'
            ]);
        }
    }
}
