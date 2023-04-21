<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Seed Saroj user
        User::create([
            'name' => 'Saroj',
            'email' => 'sharma-s2@ulster.ac.uk',
            'password' => Hash::make('password1234')
        ]);

        // Seed Sole Admin
        User::create([
            'name' => 'admin',
            'email' => 'admin@images-app.com',
            'password' => Hash::make('admin'),
            'is_admin' => true
        ]);

        // Seed 4 additional fake users
        User::factory(4)->create();
    }
}
