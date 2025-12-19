<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $students = [
            [
                'admission_no' => '2025-001',
                'user_id' => 3,
                'class_id' => 1,
                'section' => 'A',
                'status' => 'enrolled',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'admission_no' => '2025-002',
                'user_id' => 3,
                'class_id' => 2,
                'section' => 'B',
                'status' => 'enrolled',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'admission_no' => '2025-003',
                'user_id' => 3,
                'class_id' => 3,
                'section' => 'C',
                'status' => 'inactive',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($students as $student) {
            DB::table('students')->updateOrInsert(
                ['admission_no' => $student['admission_no']], 
                $student
            );
        }
    }
}
