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

Route::get('/test', function(){return test();});
Route::get('/item/test',[ItemController::class, 'test']);
Route::get('/item/all',[ItemController::class, 'fetchAll']);
Route::post('/item/push',[ItemController::class, 'push']);
Route::put('/item/edit',[ItemController::class,'patch']);
Route::delete('/item/remove',[ItemController::class,'remove']);