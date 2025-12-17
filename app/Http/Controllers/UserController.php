<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use Exception ; 
use App\Http\Requests\LoginRequest; 
use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserResource;
use App\Interface\UserInterface; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use App\Class\ApiResponse;
use App\Models\User;

class UserController extends Controller
{
    private UserInterface $userInterface; 
    public function __construct(UserInterface $userInterface){
        $this->userInterface = $userInterface; 
    }
    public function signup(SignupRequest $request){
        DB::beginTransaction();
        try{
            $details = [
                'name'=>$request->F_name.''.$request->L_name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'password'=>Hash::make($request->password),
                'gender'=>$request->gender,
                'address'=>$request->address,
                'fathers_name'=>$request->fathers_name
            ];
            $user = $this->userInterface->store($details);
            DB::commit();
            return ApiResponse::sendResponse(new UserResource($user),'user has been successfully registered',201,'');
        }catch(Exception $e){
            return ApiResponse::rollback($e);
        }
    }
    public function login(LoginRequest $request){
        try{
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                $user = User::where('email',$request->email)->first();
                $abilities = ['read'];
                $token = $user->createToken('api-token',$abilities)->plainTextToken;
                return ApiResponse::sendResponse($token,'Login Successful!',200,'');
            }else{
                return ApiResponse::sendResponse('','either email or password is incorrect',401,'');
            }
        }catch(Exception $e){
            return ApiResponse::rollback($e);
        }
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return ApiResponse::sendResponse('','logout',200,'');
    }
}
