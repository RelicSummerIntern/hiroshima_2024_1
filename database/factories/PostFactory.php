<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomNumber(10) + 1,
            'title' => fake()->sentence(1),
            'content' => fake()->sentence(10),
            'reward' => fake()->randomNumber(10000),
            'date' => now(),
            'address' => "OO市XX町"
        ];
    }
}
