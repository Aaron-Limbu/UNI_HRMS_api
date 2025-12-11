<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception; 
use App\Class\ApiResponse;
use App\Http\Requests\AddEmp;
use App\Http\Resources\EmployeeResource;
use App\Interface\EmpInterface; 


class AdminController extends Controller
{
    private EmpInterface $empInterface; 
    public function __constructc(EmpInterface $empInterface){
        $this->empInterface = $empInterface; 
    }   
    public function showAllEmployees(){

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
