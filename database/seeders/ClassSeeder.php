<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $classes = [
            ['name' => 'Mathematics'],
            ['name' => 'Physics'],
            ['name' => 'Chemistry'],
            ['name' => 'Biology'],
            ['name' => 'Computer Science'],
            ['name' => 'Information Technology'],
            ['name' => 'English Literature'],
            ['name' => 'History'],
            ['name' => 'Economics'],
            ['name' => 'Business Studies'],
            ['name' => 'Psychology'],
            ['name' => 'Sociology'],
            ['name' => 'Philosophy'],
            ['name' => 'Political Science'],
            ['name' => 'Mechanical Engineering'],
            ['name' => 'Electrical Engineering'],
            ['name' => 'Civil Engineering'],
        ];

        foreach ($classes as $class) {
            DB::table('classes')->updateOrInsert($class);
        }
    }
}
