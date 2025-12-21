<?php

namespace App\Interface;

interface ClassInterface
{
    public function showAll();
    public function Create(array $data);
    public function getDetail($id);
}
