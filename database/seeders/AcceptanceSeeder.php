<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Acceptance;

class AcceptanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Acceptance::create([
            'id' => 1,
            'post_id' => 10,
            'user_id' => 20,
            'is_completed' => False
        ]);
    }
}
