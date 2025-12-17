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
}
