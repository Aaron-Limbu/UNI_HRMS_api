<?php

namespace App\Interface;

interface AttenInterface
{
    public function showAll();
    public function getAttendance($id);
    public function create(array $data);
}
