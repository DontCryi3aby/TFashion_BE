<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $avatar_url = $this->faker->imageUrl();
        return [
            'fullname' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'avatar' => "avatars/$avatar_url",
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'role_id' => Role::factory(),
            'deleted' => false,
        ];
    }
}