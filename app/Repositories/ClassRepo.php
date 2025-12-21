<?php

namespace App\Repositories;
use App\Interface\ClassInterface;
use App\Models\Classes;

class ClassRepo implements ClassInterface
{
   public function showAll(){
      return Classes::all();
   }
   public function Create(array $data){
      return Classes::create($data);
   }
   public function getDetail($id){
      return Classes::where('id',$id)->firstOrFail();
   }
}
