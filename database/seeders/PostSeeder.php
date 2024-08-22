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

        // Post::factory()->create([
        //     'title' => '荷物が重すぎ...',
        //     'content' => '荷物が重すぎて運べません。手伝ってください。',
        //     'reward' => 500,
        //     'deadline' => '2024-09-23 18:00:00',
        //     'address' => "広島県広島市中区本通10−1",
        //     'user_id' => $user->id,
        //     'is_completed' => 0
        // ]);

        // Post::factory()->create([
        //     'title' => '犬を探してほしい',
        //     'content' => '平和記念公園付近で犬を見失いました。お時間がある方、助けていただけると助かります。',
        //     'reward' => 100000,
        //     'deadline' => '2024-08-23 19:00:00',
        //     'address' => "広島県広島市中区中島町1丁目1−10",
        //     'user_id' => $user->id,
        //     'is_completed' => 0
        // ]);

        // Post::factory()->create([
        //     'title' => '電球変えたい',
        //     'content' => '電球を交換したいのですが、どなたか手伝ってくれませんか？',
        //     'reward' => 1000,
        //     'deadline' => '2024-08-26 19:00:00',
        //     'address' => "広島県広島市東区二葉の里2丁目1−18",
        //     'user_id' => $user->id,
        //     'is_completed' => 0
        // ]);
    }
}
