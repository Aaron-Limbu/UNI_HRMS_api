<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(['prefix' => 'guest'], function () {
    Route::post('signin', [UserController::class, 'signup'])->name('guest.signin');
    Route::post('login', [UserController::class, 'login'])->name('guest.login');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [UserController::class, 'logout'])->name('user.logout');
    Route::middleware('abilities:read')->group(function () {
        Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    });

});
Route::prefix('admin')->group(function () {
    Route::post('login',[AdminController::class,'login'])->name('admin.login');
    Route::middleware(['auth:sanctum','abilities:write'])->group(function(){
        Route::post('addEmp', [AdminController::class, 'addEmp'])->name('admin.addEmployee');
        Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
        Route::get('allEmp', [AdminController::class, 'showAllEmployees'])->name('admin.allEmp');
        Route::post('addStaff',[AdminController::class,'addStaff'])->name('admin.addStaff');
        Route::get('staffs',[AdminController::class,'showAllStaff'])->name('admin.allStaffs');
        Route::get('staff/{id}',[AdminController::class,'getStaffDetail'])->name('admin.getStaff');
        Route::patch('updateRole/{id}',[AdminController::class,'changeRole'])->name('admin.updateRole');
        Route::delete('remove/staff/{id}',[AdminController::class,'removeStaff'])->name('admin.removeStaff');
        Route::get('classes',[AdminController::class,'showClasses'])->name('admin.allClasses');
        Route::get('students',[AdminController::class,'students'])->name('admin.students');
        Route::get('departments',[AdminController::class,'showDepartments'])->name('admin.allDepartments');

        Route::get('designations',[AdminController::class,'showDesignations'])->name('admin.allDesignations');
    });
});