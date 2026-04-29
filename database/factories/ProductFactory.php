<?php

namespace Database\Factories;

use App\Models\Vendor;
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
            'vendor_id' => Vendor::factory(),
            'product_type' => $this->faker->randomElement(['t-shirts', 'apparel', 'accessories']),
            'title' => $this->faker->sentence(),
            'body_html' => '<p>'.$this->faker->paragraph().'</p>',
            'handle' => $this->faker->unique()->slug(3),
            'status' => 'active',
            'published_at' => now(),
        ];
    }
}
