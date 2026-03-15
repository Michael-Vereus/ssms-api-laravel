<?php
declare(strict_types=1);

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

function test(): JsonResponse{
    return response()->json([
        "msg" => "API is Running"
    ]);
}

Route::get('/test', function(){
    return test();
});