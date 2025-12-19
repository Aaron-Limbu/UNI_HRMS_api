<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "students"; 
    protected $fillable = [
        'admission_no',
        'user_id',
        'class_id',
        'section',
        'status'
    ];
    public function class(){
        return $this->belongsToMany(Classes::class,'class_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
