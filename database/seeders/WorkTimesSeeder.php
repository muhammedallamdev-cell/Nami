<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkTimesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('work_times')->insert([
            [
                'date' => '2025-10-05',
                'hours' => 2,
                'emp_id' => 3,
                'project_id' => 2,
                'modul_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-10-05',
                'hours' => 3,
                'emp_id' => 3,
                'project_id' => 3,
                'modul_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-10-01',
                'hours' => 4.5,
                'emp_id' => 1,
                'project_id' => 2,
                'modul_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-10-01',
                'hours' => 7,
                'emp_id' => 2,
                'project_id' => 1,
                'modul_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-10-02',
                'hours' => 6.2,
                'emp_id' => 3,
                'project_id' => 3,
                'modul_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-10-02',
                'hours' => 3.8,
                'emp_id' => 4,
                'project_id' => 2,
                'modul_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-10-03',
                'hours' => 5.7,
                'emp_id' => 5,
                'project_id' => 2,
                'modul_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-10-03',
                'hours' => 2,
                'emp_id' => 1,
                'project_id' => 3,
                'modul_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-10-04',
                'hours' => 8,
                'emp_id' => 2,
                'project_id' => 2,
                'modul_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
