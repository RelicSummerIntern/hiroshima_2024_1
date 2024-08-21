<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PostTag;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post = Post::first();

        PostTag::create([
            'post_id' => $post->id,
            'tag_id' => 2,
        ]);

        PostTag::create([
            'post_id' => $post->id,
            'tag_id' => 3,
        ]);
    }
}