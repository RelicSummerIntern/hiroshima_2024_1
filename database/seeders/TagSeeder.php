<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create([
            'tag_name' => "手助け",
        ]);

        Tag::create([
            'tag_name' => "探し物",
        ]);

        Tag::create([
            'tag_name' => "その他",
        ]);
    }
}
