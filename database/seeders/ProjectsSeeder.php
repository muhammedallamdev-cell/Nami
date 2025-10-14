<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'name' => 'Website Redesign',
                'start_date' => '2025-10-05',
                'end_date' => '2025-11-05',
                'total_days' => 31,
                'total_employees' => 3,
                'total_cost' => 5500.00,
                'status' => 'In Progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mobile App',
                'start_date' => '2025-10-05',
                'end_date' => '2025-11-05',
                'total_days' => 31,
                'total_employees' => 3,
                'total_cost' => 5500.00,
                'status' => 'Completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'API Stabilization',
                'start_date' => '2025-10-05',
                'end_date' => '2025-11-05',
                'total_days' => 31,
                'total_employees' => 3,
                'total_cost' => 5500.00,
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
