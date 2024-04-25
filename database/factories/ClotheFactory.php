<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clothes>
 */
class ClotheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'unit_price' => fake()->numberBetween(1, 500) . fake()->numberBetween(1, 99),
            'provider_id' => fake()->numberBetween(1, 6),
            'sub_category_id' => fake()->numberBetween(1, 15),
        ];
    }
}
