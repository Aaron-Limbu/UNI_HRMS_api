<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::group(['prefix'=>'guest'],function(){
    Route::post('signin',[UserController::class,'signup'])->name('guest.signin');
    Route::post('login',[UserController::class,'login'])->name('guest.login');
});
Route::group(['middleware'=>'auth:sanctum'],function(){
    
});