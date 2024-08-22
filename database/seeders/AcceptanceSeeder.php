<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Acceptance;
use App\Models\Post;
use App\Models\User;

class AcceptanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post = Post::first();
        $user = User::first();

        Acceptance::create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'is_completed' => False
        ]);

        Acceptance::create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'is_completed' => True
        ]);
    }
}
