<?php

namespace App\Http\Responses;

class ApiResponse
{
    public static function success($message = 'Success',$statusCode,$data=[]){
        return response() -> json([
            'message' => $message,
            'statusCode' => $statusCode,
            'error' => false,
            'data' => $data
        ],$statusCode);
    }

    public static function error($message = 'Error',$statusCode,$data=[]){
        return response() -> json([
            'message' => $message,
            'statusCode' => $statusCode,
            'error' => true,
            'data' => $data
        ],$statusCode);
    }
}
