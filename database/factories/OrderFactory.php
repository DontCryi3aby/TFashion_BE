<?php

namespace Database\Factories;

use App\Models\User;
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
            'user_id' => User::factory(),
            'fullname' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'note' => $this->faker->text(),
            'order_date' => $this->faker->dateTimeThisDecade(),
            'status' => $this->faker->randomElement(['PENDING', 'FULFILLED', 'REJECTED']),
            'total_money' => $this->faker->numberBetween(20,200)
        ];
    }
}