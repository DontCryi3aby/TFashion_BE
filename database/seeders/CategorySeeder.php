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
        // DB::table('categories')->insert([
        //     'name' => 'Spring Premium Suite'
        // ]);
        // DB::table('categories')->insert([
        //     'name' => 'Summer Deluxe'
        // ]);
        // DB::table('categories')->insert([
        //     'name' => 'Autumn Chamber'
        // ]);
        // DB::table('categories')->insert([
        //     'name' => 'Winter Suite'
        // ]);

        Category::factory()->count(1)->hasProducts(20)->create();
        Category::factory()->count(1)->hasProducts(10)->create();
        Category::factory()->count(1)->hasProducts(40)->create();
        Category::factory()->count(1)->hasProducts(30)->create();
    }
}