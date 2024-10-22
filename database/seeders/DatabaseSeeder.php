<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(
            ['name' => 'Admin'],
        );
        Role::create(
            ['name' => 'Teacher'],
        );
        Role::create(
            ['name' => 'Student'],
        );
    }
}
