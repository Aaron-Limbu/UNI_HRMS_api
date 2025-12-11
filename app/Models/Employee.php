<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table="employees";
    protected $fillable = [
        'user_id',
        'employee_code',
        'employment_type',
        'join_date',
        'department_id',
        'designation_id',
        'status',
    ];
}
