<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator; 
use Illuminate\Http\Exceptions\HttpResponseException; 

class AddEmp extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id'=>'required|numeric|in:users',
            'employee_code'=>'required',
            'employee_type'=>'required|enum:permanent,contract',
            'join_date'=>'required|date',
            'department_id'=>'nullable',
            'designation_id'=>'nullable',
            'status'=>'required|enum:active,resigned,terminated'
        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'message'=>'Validation errors',
            'data'=>$validator->errors()
        ]));
    }
}
