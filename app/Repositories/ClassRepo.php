<?php

namespace App\Repositories;
use App\Interface\ClassInterface;
use App\Models\Classes;

class ClassRepo implements ClassInterface
{
   public function showAll(){
        return Classes::all();
   }
}
