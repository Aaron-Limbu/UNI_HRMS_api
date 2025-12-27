<?php

namespace App\Repositories;
use App\Interface\DesignationInterface; 
use App\Models\Designation; 

class DesignationRepo implements DesignationInterface
{
    public function showAll(){
        return Designation::all();
    }
    public function getDesig($id){
        return Designation::findOrFail($id);
    }
}
