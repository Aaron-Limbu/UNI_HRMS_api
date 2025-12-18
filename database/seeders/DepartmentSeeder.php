<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'Computer Science & Engineering'],
            ['name' => 'Information Technology'],
            ['name' => 'Electrical & Electronics Engineering'],
            ['name' => 'Civil Engineering'],
            ['name' => 'Mechanical Engineering'],
            ['name' => 'Physics'],
            ['name' => 'Chemistry'],
            ['name' => 'Mathematics & Statistics'],
            ['name' => 'Business Administration'],
            ['name' => 'Economics'],
            ['name' => 'English & Humanities'],
            ['name' => 'Library & Information Science'],
            ['name' => 'Research & Development'],
            ['name' => 'Admissions Office'],
            ['name' => 'Finance & Accounts'],
            ['name' => 'Examination Control'],
            ['name' => 'Student Affairs'],
            ['name' => 'Quality Assurance'],
            ['name' => 'Registrar Office'],
        ];


        foreach ($departments as $dept) {
            Department::updateOrCreate($dept);
        }   
    }
}
