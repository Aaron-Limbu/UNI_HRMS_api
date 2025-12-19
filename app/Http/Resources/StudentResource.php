<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'admission_no'=>$this->admission_no,
            'user_id'=>$this->user_id,
            'class_id'=>$this->class_id,
            'section'=>$this->section,
            'status'=>$this->status
        ];
    }
}
