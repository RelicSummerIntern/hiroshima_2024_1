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
            'title' => '荷物が重すぎ...',
            'content' => '荷物が重すぎて運べません。手伝ってください。',
            'reward' => 500,
            'deadline' => '2024-09-23 18:00:00',
            'address' => "広島県広島市中区本通10−1",
            'user_id' => $user->id,
            'is_completed' => 0
        ]);

        Post::factory()->create([
            'title' => '犬を探してほしい',
            'content' => '平和記念公園付近で犬を見失いました。お時間がある方、助けていただけると助かります。',
            'reward' => 100000,
            'deadline' => '2024-08-23 19:00:00',
            'address' => "広島県広島市中区中島町1丁目1−10",
            'user_id' => $user->id,
            'is_completed' => 0
        ]);

        Post::factory()->create([
            'title' => '電球変えたい',
            'content' => '電球を交換したいのですが、どなたか手伝ってくれませんか？',
            'reward' => 1000,
            'deadline' => '2024-08-26 19:00:00',
            'address' => "広島県広島市東区二葉の里2丁目1−18",
            'user_id' => $user->id,
            'is_completed' => 0
        ]);

        Post::factory()->create([
            'title' => '買い物の代行',
            'content' => '仕事が忙しくて買い物に行けません。代わりに買い物をしていただける方を探しています。',
            'reward' => 3000,
            'deadline' => '2024-08-25 12:00:00',
            'address' => "〒730-0014 広島県広島市中区上幟町2−22",
            'user_id' => $user->id,
            'is_completed' => 0
        ]);

        Post::factory()->create([
            'title' => '引越しの手伝い',
            'content' => '引越しの手伝いをしていただける方を募集しています。力仕事が得意な方歓迎です。',
            'reward' => 5000,
            'deadline' => '2024-09-01 16:00:00',
            'address' => "〒732-0803 広島県広島市南区南蟹屋2丁目3−1",
            'user_id' => $user->id,
            'is_completed' => 0
        ]);
    }
}
