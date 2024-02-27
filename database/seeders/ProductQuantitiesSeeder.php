<?php

namespace Database\Seeders;

use App\Models\ProductQuantities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductQuantitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductQuantities::factory()->count(100)->create();
    }
}