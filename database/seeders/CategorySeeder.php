<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(1)->hasProducts(20)->create();
        Category::factory()->count(1)->hasProducts(10)->create();
        Category::factory()->count(1)->hasProducts(40)->create();
        Category::factory()->count(1)->hasProducts(30)->create();
    }
}