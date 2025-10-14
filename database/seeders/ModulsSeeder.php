<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('moduls')->insert([
            [
                'date' => '2025-10-01',
                'employee' => 'Alice Johnson',
                'name' => 'Testing Module',
                'project' => 'Website Redesign',
                'hours' => 6.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-10-02',
                'employee' => 'Bob Smith',
                'name' => 'Design Module',
                'project' => 'API Stabilization',
                'hours' => 7.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-10-02',
                'employee' => 'Carol Davis',
                'name' => 'Testing Module',
                'project' => 'Mobile App',
                'hours' => 5.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-10-03',
                'employee' => 'David Wilson',
                'name' => 'Backend Module',
                'project' => 'Website Redesign',
                'hours' => 8.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-10-03',
                'employee' => 'Emily Brown',
                'name' => 'Frontend Module',
                'project' => 'API Stabilization',
                'hours' => 6.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
