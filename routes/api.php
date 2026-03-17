<?php
declare(strict_types=1);

use App\Http\Controllers\ItemController;
use App\Http\Controllers\TestController;
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
Route::get('/test-api',[ItemController::class, 'test']);