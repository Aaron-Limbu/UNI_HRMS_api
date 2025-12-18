<?php

namespace App\Repositories;

use App\Interface\EmpInterface;
use App\Models\Employee;

class EmpRepo implements EmpInterface
{
   
        public function showAll(){
            return Employee::orderBy('created_at','ASC')->get();
        }
        public function showEmp($id){
            return Employee::findOrFail($id);
        }
        public function store(array $data){
            return Employee::create($data);
        }
        public function delete($id){
            return Employee::destroy($id);
        }
        public function getAllStaff(){
            return Employee::whereHas('user', function($q){
                    $q->where('role','staff');
                })->with(['user:id,name,email,role'])->get();
        }
        public function getStaff($id){
            return Employee::with(['user:id,name,email,role'])->findOrFail($id);
        }
        public function updateStaffDetail($id,array $data){
            return Employee::where('id',$id)->update($data);
        }
}
