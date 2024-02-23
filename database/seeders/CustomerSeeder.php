<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()->count(10)->hasOrders(5)->hasReview(1)->create();
        Customer::factory()->count(20)->hasOrders(3)->hasReview(1)->create();
        Customer::factory()->count(20)->hasOrders(1)->hasReview(0)->create();
    }
}