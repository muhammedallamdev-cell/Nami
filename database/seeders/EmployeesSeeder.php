<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'name' => 'Alice Johnson',
                'salary' => 1000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bob Smith',
                'salary' => 3000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carol Davis',
                'salary' => 2500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'David Wilson',
                'salary' => 1800.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Emily Brown',
                'salary' => 2200.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
