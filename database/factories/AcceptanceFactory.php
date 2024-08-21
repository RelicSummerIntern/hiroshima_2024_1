<?php

namespace Database\Factories;

use App\Models\Acceptance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Acceptance>
 */
class AcceptanceFactory extends Factory
{
    protected $model = Acceptance::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => fake()->randomNumber(10) + 1,
            'user_id' => fake()->randomNumber(10) + 1,
            'is_completed' => False
        ];
    }
}
