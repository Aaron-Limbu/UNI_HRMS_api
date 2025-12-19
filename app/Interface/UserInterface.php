<?php

namespace App\Interface;

interface UserInterface
{
    public function store(array $data);
    public function delete($id);
    public function updateRole($id,$role);
    public function info($id);
}
