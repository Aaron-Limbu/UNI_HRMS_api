<?php

namespace App\Interface;

interface EmpInterface
{
    public function showAll();
    public function showEmp($id);
    public function store(array $data);
    public function delete($id);
    public function getAllStaff();
    public function getStaff($id);
    public function updateStaffDetail($id,array $data);
}
