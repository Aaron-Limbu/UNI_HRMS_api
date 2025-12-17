<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB; 
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'HR Admin',
                'email' => 'admin@university.edu',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'gender' => 'male',
                'uimage' => null,
                'address' => 'University Main Campus, Building A',
                'phone' => '9811111111',
                'fathers_name' => 'John Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Teacher Account',
                'email' => 'teacher@university.edu',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'teacher',
                'gender' => 'female',
                'uimage' => null,
                'address' => 'Faculty Housing Block 3',
                'phone' => '9822222222',
                'fathers_name' => 'Mary Smith',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Student Account',
                'email' => 'student@university.edu',
                'email_verified_at' => null,
                'password' => Hash::make('password123'),
                'role' => 'student',
                'gender' => 'male',
                'uimage' => null,
                'address' => 'Hostel A Room 204',
                'phone' => '9833333333',
                'fathers_name' => 'David Kumar',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Staff Account',
                'email' => 'staff@university.edu',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'staff',
                'gender' => 'female',
                'uimage' => null,
                'address' => 'Admin Office Block B',
                'phone' => '9844444444',
                'fathers_name' => 'Robert Staff',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Guest User',
                'email' => 'guest@university.edu',
                'email_verified_at' => null,
                'password' => Hash::make('password123'),
                'role' => 'guest',
                'gender' => 'male',
                'uimage' => null,
                'address' => 'N/A',
                'phone' => '9000000000',
                'fathers_name' => 'Unknown',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
