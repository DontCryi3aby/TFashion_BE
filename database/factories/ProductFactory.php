<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_type' => $this->faker->randomElement(['t-shirts', 'apparel', 'accessories']),
            'title' => $this->faker->sentence(),
            'body_html' => '<p>'.$this->faker->paragraph().'</p>',
            'vendor' => $this->faker->company(),
            'handle' => $this->faker->unique()->slug(3),
            'status' => 'active',
            'published_at' => now(),
            'quantity' => $this->faker->numberBetween(20, 100),
            'price' => $this->faker->numberBetween(10, 100),
            'discount' => $this->faker->optional()->randomFloat(2, 5, 30),
            'deleted' => false,
        ];
    }
}
