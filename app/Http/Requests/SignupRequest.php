<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator; 
use Illuminate\Http\Exceptions\HttpResponseException ; 

class SignupRequest extends FormRequest
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
            'F_name'=>'required|string',
            'L_name'=>'required|string',
            'email'=>'required|email|unique:users',
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'fathers_name'=>'required',
            'password'=>'required|min:8|confirmed',
            'password_confirmation'=>'required'
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
