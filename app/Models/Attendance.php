<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table="attendance";
    protected $fillable = [
        'user_id',
        'date',
        'check_in',
        'check_out',
        'status'
    ];
}
