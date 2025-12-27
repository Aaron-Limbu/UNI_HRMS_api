<?php

namespace App\Repositories;
use App\Models\Attendance;
use App\Interface\AttenInterface;

class AttenRepo implements AttenInterface
{
    public function showAll(){
        return Attendance::all();
    }
    public function getAttendance($id){
        return Attendance::findOrFail($id);
    }
    public function create(array $data){
        return Attendance::create($data);
    }
}
