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
}
