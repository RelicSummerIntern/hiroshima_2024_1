<?php

namespace Database\Factories;

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
            'id' => 1
            'post_id' => 10,
            'user_id' => 20,
            'is_completed' => False
        ];
    }
}
