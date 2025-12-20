<?php

namespace App\Repositories;
use App\Interface\DepartmentInterface;
use App\Models\Department;

class DepartmentRepo implements DepartmentInterface
{
    public function showAll(){
        return Department::all();
    }
}
