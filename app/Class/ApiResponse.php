<?php

namespace App\Class;

use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Exceptions\HttpResponseException; 
use Illuminate\Support\Facades\Log; 

class ApiResponse
{
    public static function rollback($e,$message="Something went wrong! process not completed"){
        DB::rollback();
        self::throw($e,$message);
    }
    public static function throw($e,$message="Something went wrong! Process not completed"){
        Log::info($e);
        throw new HttpResponseException(response()->json(["message"=>$message],500));
    }
    public static function sendResponse($result,$message = null,$code=200,$redirectUrl=null){
        $response = [
            'success'=>true,
            'data'=>$result
        ];
        if($message){
            $response['message']=$message; 
        }if($redirectUrl){
            $response['redirect_url']=$redirectUrl;
        }
        return response()->json($response,$code);
    }
}
