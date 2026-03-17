<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestController extends Controller {
    
    public function __construct() {
        
    }
    
    public function test(): JsonResponse{
        return response()->json([
            "status"=>true,
            "msg"=>"Test Controller is Running"
        ]);
    }
}
