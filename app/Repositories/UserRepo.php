<?php

namespace App\Repositories;
use App\Interface\UserInterface;
use App\Models\User;

class UserRepo implements UserInterface
{
    public function store(array $data){
        return User::create($data);
    }
    public function delete($id){
        return User::destroy($id);
    }
    public function updateRole($id,$role){
        return User::where('id',$id)->update(['role'=>$role]);
    }
    public function info($id){
       return User::with([
            'employees:id,user_id,employee_code,join_date,status,department_id,designation_id',
            'employees.department:id,name',
            'employees.designation:id,title',
        ])
        ->findOrFail($id);

    }
}
