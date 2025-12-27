<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;
use Exception; 
use App\Class\ApiResponse;
use App\Http\Requests\Emp;
use App\Http\Resources\EmployeeResource;
use App\Interface\EmpInterface; 
use App\Http\Requests\LoginRequest;
use Auth;
use App\Models\User;
use App\Interface\UserInterface;
use App\Http\Resources\UserResource;
use App\Http\Requests\RoleRequest;
use App\Interface\StudentInterface;
use App\Http\Resources\StudentResource;
use App\Interface\ClassInterface;
use App\Http\Resources\ClassResource;
use App\Http\Requests\classReq;
use App\Interface\DepartmentInterface;
use App\Http\Resources\DepartmentResource;
use App\Interface\DesignationInterface; 
use App\Http\Resources\DesignationResource;
use App\Http\Resources\AttenResource;
use App\Interface\AttenInterface;
use App\Http\Requests\AttenReq;


class AdminController extends Controller
{
    private EmpInterface $empInterface; 
    private UserInterface $userInterface;
    private StudentInterface $studentInterface;
    private ClassInterface $classInterface;
    private DepartmentInterface $departmentInterface;
    private DesignationInterface $designationInterface; 
    private AttenInterface $attendanceInterface;

    public function __construct(EmpInterface $empInterface,UserInterface $userInterface,
    StudentInterface $studentInterface,ClassInterface $classInterface,
    DepartmentInterface $departmentInterface,DesignationInterface $designationInterface,
    AttenInterface $attendanceInterface){
        $this->empInterface = $empInterface; 
        $this->userInterface = $userInterface;
        $this->studentInterface = $studentInterface;
        $this->classInterface = $classInterface;
        $this->departmentInterface = $departmentInterface; 
        $this->designationInterface = $designationInterface;
        $this->attendanceInterface = $attendanceInterface;
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
            Log::error('Failed to login: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e,'failed');
        }
    }
    public function showAllEmployees(){
        try{
            $data = $this->empInterface->showAll(); 
            return ApiResponse::sendResponse(['employees'=>EmployeeResource::collection($data)],'employees',200,'');
        }catch(Exception $e){
            Log::error('Failed to show employees:'.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e,'failed');
        }
    } 

    public function showAllStaff(){
        try {
            $data = $this->empInterface->getAllStaff(); 
            return ApiResponse::sendResponse(['staffs' => EmployeeResource::collection($data)], 'Staff list', 200);
        } catch (Exception $e) {
            Log::error('Failed to show staffs: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e, 'Failed to fetch staffs');
        }

    }
    public function addStaff(Emp $request){
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
            $user = $this->userInterface->updateRole($request->user_id,"staff");
            DB::commit();
            return ApiResponse::sendResponse(['employee'=> new EmployeeResource($employee),'user' => new UserResource($user)],'employee has been added.',201,'');
        }catch(Exception $e){
            Log::error('Failed to add staff: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }
    }
    public function getStaffDetail($id){
        try{
            $staff = $this->empInterface->getStaff($id); 
            return ApiResponse::sendResponse(['employee'=> new EmployeeResource($staff)],'staff detail',200,'');
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResponse::sendResponse('', 'Staff not found', 404);
        } 
        catch(Exception $e){
            Log::error('Failed to get staff detail: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }

    }
    public function updateStaff(Emp $request,$id){
        DB::beginTransaction();
        try{
            $this->empInterface->updateStaffDetail(
                collect(
                    $request->validated())->only([
                        'employee_code','employee_type','join_date','department_id','designation_id','status'
                ])->toArray()
            );
            DB::commit();
            return ApiResponse::sendResponse('','successfully updated staff',200);
            
        }catch(Exception $e){
            Log::error('Failed to update staff detail: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }
    }
    public function removeStaff($id){
        DB::beginTransaction();
        try{
            $this->empInterface->delete($id);
            $role = "guest";
            $this->userInterface->updateRole($id,$role);
            DB::commit();
            return ApiResponse::sendResponse('','staff removed',200,'');
        }catch(Exception $e){
            Log::error('Failed to remove staff: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }
    }
    public function getEmp(){

    }
    public function addEmp(Emp $request){
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
            Log::error('Failed to add Employee: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }
    }
    public function changeRole(RoleRequest $request,$id){
        DB::beginTransaction();
        try{
            $this->userInterface->updateRole($id,$request->role);
            DB::commit();
            return ApiResponse::sendResponse('','user role has been changed',201,'');
        }catch(Exception $e){
            Log::error('Failed to change role: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }
    }
    public function students(){
        try{
            $students = $this->studentInterface->showAll();
            return ApiResponse::sendResponse(['students'=>StudentResource::collection($students)],'students data',200,'');
        }catch(Exception $e){
            Log::error('Failed to fetch students: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }
    }
    public function getStudent($id){
        try{
            $student = $this->studentInterface->getStudent($id);
            return ApiResponse::sendResponse(['student'=>new StudentResource($student)],'student info',200);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResponse::sendResponse('', 'student not found', 404);
        } 
        catch(Exception $e){
            Log::error('Failed to fetch student: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }
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
    public function addClasses(classReq $request){
        DB::beginTransaction();
        try{
            $details = [
                'name'=>$request->name,
            ];
            $class= $this->classInterface->Create($details); 
            DB::commit();
            return ApiResponse::sendResponse(['class'=>new ClassResource($class)],'successfully added class',201);
        }catch(Exception $e){
            Log::error('Failed to add class: '.$e->getMessage(), [
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
    public function departmentDetail($id){
        try{
            $department = $this->departmentInterface->getDepartment($id);
            return ApiResponse::sendResponse(['department'=>new DepartmentResource($department)],'department',200);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResponse::sendResponse('', 'department not found', 404);
        } catch(Exception $e){
            Log::error('Failed to fetch department: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }
    }
    public function showDesignations(){
        try{
            $designations = $this->designationInterface->showAll();
            return ApiResponse::sendResponse(['designations'=>DesignationResource::collection($designations)],'designations',200);
        }catch(Exception $e){
            Log::error('Failed to fetch designations: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }
    }
    public function Designation($id){
        try{
            $desgination = $this->designationInterface->getDesig($id);
            return ApiResponse::sendResponse(['designation'=>new DesignationResource($desgination)],'designation',200);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResponse::sendResponse('', 'Designation not found', 404);
        } catch(Exception $e){
            Log::error('Failed to fetch designation: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }
    }
    public function showAttendances(){
        try{
            $attendances = $this->attendanceInterface->showAll();
            return ApiResponse::sendResponse(['attendances'=>AttenResource::collection($attendances)],'attendances',200);
        }catch(Exception $e){
            Log::error('Failed to fetch attendances: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }
    }
    public function attendance($id){
        try{
            $attendance = $this->attendanceInterface->getAttendance($id);
            return ApiResponse::sendResponse(['attendance'=>new AttenResource($attendance)],'attendance',200);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResponse::sendResponse('', 'Attendance not found', 404);
        } catch(Exception $e){
            Log::error('Failed to fetch attendance: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }
    }
    
    public function addAttendance(AttenReq $request){
        DB::beginTransaction();
        try{
            $details = [
                'user_id'=>$request->user_id,
                'date'=>$request->date,
                'check_in'=>$request->check_in,
                'check_out'=>$request->check_out,
                'status'=>$request->status
            ];
            $attendance = $this->AttenInterface->create($details);
            DB::commit();
            return ApiResponse::sendResponse(['attendance'=>new AttenResource($attendance)],'attendance added',201);
        }catch(Exception $e){
            Log::error('Failed to add attendance: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ApiResponse::rollback($e);
        }
    }

}
