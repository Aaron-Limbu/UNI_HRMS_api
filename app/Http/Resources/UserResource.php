<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 'id'=>$this->id,
            'user'=>
                ['name'=>$this->name,
                'email'=>$this->email,
                'gender'=>$this->gender,
                'role'=>$this->role,
                'address'=>$this->address,
                'phone'=>$this->phone, 
                'employee_code'=>$this->employees->employee_code ??null,
                'join_date'=>$this->employees->join_date ??null,
                'status'=>$this->employees->status ??null  
             ],
            'departments'=>
             [   'name'=>$this->employees->department->name ??null
            ],
            'designations'=>
                ['title'=>$this->employees->designation->title??null
            ]
        ];
    }
}
