<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(),
            'quantity' => $this->faker->numberBetween(20, 100),
            'price' => $this->faker->numberBetween(10, 100),
            'discount' => $this->faker->numberBetween(10, 100),
            'deleted' => false
        ];
    }
}