<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id'=>$this->user_id,
            'employee_code'=>$this->employee_code,
            'employee_type'=>$this->employment_type,
            'join_date'=>$this->join_date,
            'department_id'=>$this->department_id,
            'designation_id'=>$this->designation_id,
            'status'=>$this->status
        ];
    }
}
