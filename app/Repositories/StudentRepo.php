<?php

namespace App\Repositories;
use App\Interface\StudentInterface;
use App\Models\Student;

class StudentRepo implements StudentInterface
{
    public function showAll(){
        return Student::whereHas('user',function($q){
            $q->where('role','student');
        })->with(['user:id,name,email','class:id,name'])->get();
    }
    public function getStudent($id){
        return Student::with(['user:id,name,email'])->findOrFail($id);
    }
}
