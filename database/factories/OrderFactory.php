<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'state' => fake()->randomElement(['pending', 'complete']),
            'total' => fake()->numberBetween(1, 2000),
            'user_id' => fake()->numberBetween(1, 12),
        ];
    }
}
