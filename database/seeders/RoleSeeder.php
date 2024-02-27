<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->count(3)->hasCustomers(30)->create();
        Role::factory()->count(3)->hasCustomers(2)->create();
        Role::factory()->count(3)->hasCustomers(10)->create();
    }
}