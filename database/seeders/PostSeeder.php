<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;
use App\Models\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        Post::factory()->create([
            'user_id' => $user->id,
            'address' => "OO市XX町",
            'is_completed' => True
        ]);


        Post::factory()->create([
            'user_id' => $user->id,
            'address' => "A市B町"
        ]);

        Post::factory()->create([
            'user_id' => $user->id,
            'address' => "A市B町"
        ]);
    }
}
