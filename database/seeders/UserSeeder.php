<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->hasOrders(5)->hasReviews(1)->create();
        User::factory()->count(20)->hasOrders(3)->hasReviews(1)->create();
        User::factory()->count(20)->hasOrders(1)->hasReviews(0)->create();
    }
}