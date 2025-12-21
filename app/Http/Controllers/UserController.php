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
use App\Http\Resources\ClassResource;
use App\Interface\ClassInterface;
use App\Repositories\ClassRepo;
use App\Http\Resources\DepartmentResource; 
use App\Interface\DepartmentInterface; 
use App\Repositories\DepartmentRepo; 

class UserController extends Controller
{
    private UserInterface $userInterface;
    private ClassInterface $classInterface;  
    public function __construct(UserInterface $userInterface,ClassInterface $classInterface,
    DepartmentInterface $departmentInterface){
        $this->userInterface = $userInterface; 
        $this->classInterface = $classInterface; 
        $this->departmentInterface = $departmentInterface;
    }
    public function signup(SignupRequest $request){
        DB::beginTransaction();
        try{
            $details = [
                'name'=>$request->F_name.' '.$request->L_name,
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
    public function profile(){
        $id= Auth::id();
        $user = $this->userInterface->info($id);
        return ApiResponse::sendResponse(new UserResource($user),'profile info ',200,'');
    }
    public function showClasses(){
        try{
            $classes = $this->classInterface->showAll();
            return ApiResponse::sendResponse(['classes'=>ClassResource::collection($classes)],'classes info',200,'');
        }catch(Exception $e){
            Log::error('Failed to fetch classes: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }
    }
    public function showDepartments(){
        try{
            $departments = $this->departmentInterface->showAll(); 
            return ApiResponse::sendResponse(['departments'=>DepartmentResource::collection($departments)],'departments',200);

        }catch(Exception $e){
            Log::error('Failed to fetch departments: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }
    }
    public function getClass($id){
        try{
            $class = $this->classInterface->getDetail($id); 
            return ApiResponse::sendResponse(['class'=>new ClassResource($class)],'class',200);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResponse::sendResponse('', 'class not found', 404);
        } 
        catch(Exception $e){
            Log::error('Failed to get class: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }
    }
}
