<?php
declare(strict_types=1);

use App\Http\Controllers\BinController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TestController;
use App\Models\BinEntity;
use App\Models\ItemEntity;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use function Laravel\Prompts\search;

function test(): JsonResponse{
    return response()->json([
        "msg" => "API is Running"
    ]);
}

Route::get('/test', function(){return test();});
Route::get('/item/test',[ItemController::class, 'test']);
Route::get('/item/all',[ItemController::class, 'fetchAll']);
Route::get('/item/search/{item_name}',[ItemController::class, 'search']);
Route::post('/item/push',[ItemController::class, 'push']);
Route::put('/item/edit',[ItemController::class,'patch']);
Route::delete('/item/remove',[ItemController::class,'remove']);

Route::get('/bin/test',[BinController::class,'test']);
Route::get('/bin/all',[BinController::class, 'fetchAll']);
Route::post('/bin/push',[BinController::class, 'push']);