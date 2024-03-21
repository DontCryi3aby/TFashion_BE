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
        Role::factory()->count(3)->hasUsers(30)->create();
        Role::factory()->count(3)->hasUsers(2)->create();
        Role::factory()->count(3)->hasUsers(10)->create();
    }
}