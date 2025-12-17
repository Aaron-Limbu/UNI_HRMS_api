<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Modes\Designation; 

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = [
            ['title' => 'Chancellor'],
            ['title' => 'Vice Chancellor'],
            ['title' => 'Registrar'],
            ['title' => 'Dean of Faculty'],
            ['title' => 'Head of Department'],
            ['title' => 'Professor'],
            ['title' => 'Associate Professor'],
            ['title' => 'Assistant Professor'],
            ['title' => 'Senior Lecturer'],
            ['title' => 'Lecturer'],
            ['title' => 'Research Fellow'],
            ['title' => 'Graduate Assistant'],
            ['title' => 'Administrative Officer'],
            ['title' => 'Examination Controller'],
            ['title' => 'Finance Officer'],
            ['title' => 'IT Support Specialist'],
            ['title' => 'Lab Technician'],
            ['title' => 'Clerk'],
            ['title' => 'Security Officer'],
            ['title' => 'Facilities & Housekeeping Staff'],
        ];


        foreach ($designations as $designation) {
            Designation::updateOrCreate($designation);
        }
    }
}
