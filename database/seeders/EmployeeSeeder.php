<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon; 
use DB; 

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([

            [
                'user_id' => 1, // HR Admin
                'employee_code' => 'EMP001',
                'employment_type' => 'permanent',
                'join_date' => Carbon::now()->subYears(4)->toDateString(),
                'department_id' => 10, 
                'designation_id' => 3, 
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 2, // Teacher
                'employee_code' => 'EMP002',
                'employment_type' => 'contract',
                'join_date' => Carbon::now()->subYears(2)->toDateString(),
                'department_id' => 1, 
                'designation_id' => 9, 
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 4, // Staff
                'employee_code' => 'EMP003',
                'employment_type' => 'permanent',
                'join_date' => Carbon::now()->subYears(3)->toDateString(),
                'department_id' => 10, 
                'designation_id' => 12, 
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
