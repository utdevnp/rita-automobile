<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResponseController extends Controller
{
    public function success($responseBag){
       
        return response()->json([
            'code'=> 200,
            'status'=> true,
            'message' => $responseBag['message'],
            'data'=>$responseBag['data']
        ], 200);
    }

    public function error($responseBag){
        return response()->json([
            'code'=> 400,
            'status'=> false,
            'message' => $responseBag['message'],
            'errors'=>(object)$responseBag['data']
        ], 200);
    }


    public function loginSuccess($responseBag){
        return response()->json([
            'code'=> 200,
            'status'=> true,
            'message' => $responseBag['message'],
            'token' => $responseBag['token'],
            'expires_at'=>$responseBag['expires_at'],
            'data'=>$responseBag['data']
        ], 200);
    }


    
}
