<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception; 
use App\Class\ApiResponse;
use App\Http\Requests\AddEmp;
use App\Http\Resources\EmployeeResource;
use App\Interface\EmpInterface; 
use App\Http\Requests\LoginRequest;
use Auth;
use App\Models\User;

class AdminController extends Controller
{
    private EmpInterface $empInterface; 
    public function __construct(EmpInterface $empInterface){
        $this->empInterface = $empInterface; 
    }   
    public function login(LoginRequest $request){
        try{
            if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
                if(Auth::guard('admin')->user()->role != "admin"){
                    Auth::guard('admin')->logout(); 
                    return ApiResponse::sendResponse('','not allowed',403,'');
                }
                $user = User::where('email',$request->email)->first();
                $abilities = ['read','write'];
                $token = $user->createToken('api-token',$abilities)->plainTextToken;
                return ApiResponse::sendResponse($token,'login successful',200,'');
            }else{
                return ApiResponse::sendResponse('','either email or password is incorrect',401,'');
            }
        }catch(Exception $e){
            return ApiResponse::rollback($e,'failed');
        }
    }
    public function showAllEmployees(){
        try{
            $data = $this->empInterface->showAll(); 
            if(count($data)>0){
                return ApiResponse::sendResponse(EmployeeResource::collection($data),'employees',200,'');
            }else{
                return ApiResponse::sendResponse('','no employees are stored',404,'');
            }
        }catch(Exception $e){
            return ApiResponse::rollback($e,'failed');
        }
    } 

    public function showAllStaff(){
        try{
            $data = $this->empInterface->getAllStaff(); 
            if(count($data)>0){
                return ApiResponse::sendResponse(EmployeeResource::collection($data),'staffs',200,'');
            }else{
                return ApiResponse::sendResponse('','no staffs are stored',404,'');
            }
        }catch(Exception $e){
            return ApiResponse::rollback($e,'failed');
        }
    }
    public function addStaff(){
        // DB::beginTransaction();
        // try{
        //     $details = [
        //         'user_id'=>$requset->user_id,
        //         'employee_code'=>$request->emp_code,
        //         'employment_type'=>$request->emp_type,
        //         'join_date'=>$request->join_date,
        //         'department_id'=>$request->dep_id,
        //         'designation_id'=>$request->desig_id,
        //         'status'=>$request->status,
        //     ];
        //     $employee = $this->empInterface->store($details);
        //     DB::commit();
        //     return ApiResponse::sendResponse(new EmployeeResource($employee),'employee has been added.',201,'');
        // }catch(Exception $e){
        //     return ApiResponse::rollback($e);
        // }
    }
    public function getStaffDetail(){

    }
    public function updateStaff(){

    }
    public function removeStaff(){

    }
    public function getEmp(){

    }
    public function addEmp(AddEmp $request){
        DB::beginTransaction();
        try{
            $details = [
                'user_id'=>$requset->user_id,
                'employee_code'=>$request->emp_code,
                'employment_type'=>$request->emp_type,
                'join_date'=>$request->join_date,
                'department_id'=>$request->dep_id,
                'designation_id'=>$request->desig_id,
                'status'=>$request->status,
            ];
            $employee = $this->empInterface->store($details);
            DB::commit();
            return ApiResponse::sendResponse(new EmployeeResource($employee),'employee has been added.',201,'');
        }catch(Exception $e){
            return ApiResponse::rollback($e);
        }
    }
}
