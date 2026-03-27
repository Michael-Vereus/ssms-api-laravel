<?php
declare(strict_types=1);

use App\Http\Controllers\BinController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;


// Route::get('/item/test',[ItemController::class, 'test']);
// Route::get('/item/all',[ItemController::class, 'fetchAll']);
// Route::get('/item/search/{item_name}',[ItemController::class, 'search']);
// Route::post('/item/push',[ItemController::class, 'push']);
// Route::put('/item/edit',[ItemController::class,'patch']);
// Route::delete('/item/remove',[ItemController::class,'remove']);

// Route::get('/bin/test',[BinController::class,'test']);
// Route::get('/bin/all',[BinController::class, 'fetchAll']);
// Route::get('bin/search/{bin_name}', [BinController::class, 'search']);
// Route::post('/bin/push',[BinController::class, 'push']);
// Route::put('bin/edit',[BinController::class, 'patch']);
// Route::delete('/bin/remove',[BinController::class,'remove']);

// Route::get('/stock/test',[StockController::class,'test']);
// Route::get('/stock/all',[StockController::class, 'fetchAll']);
// Route::get('stock/search/{stock_name}', [StockController::class, 'search']);
// Route::post('/stock/push',[StockController::class, 'push']);
// Route::put('stock/edit',[StockController::class, 'patch']);
// Route::delete('/stock/remove',[StockController::class,'remove']);
// Route::patch('/stock/restore',[StockController::class, 'restore']);

// work in progress do not touch
$modules = [
    'item'  => ItemController::class,
    'bin'   => BinController::class,
    'stock' => StockController::class,
];

// 2. Loop through and register everything at once
foreach ($modules as $prefix => $controller) {
    Route::prefix($prefix)->controller($controller)->group(function () use ($prefix) {
        Route::get('/test', 'test');
        Route::get('/all', 'fetchAll'); // Changed to index for standard
        Route::get("/search/{{$prefix}_name}", 'search');
        Route::post('/push', 'push');
        Route::put('/edit', 'patch');
        Route::delete('/remove', 'remove');
    });
}
Route::patch('/stock/restore',[StockController::class, 'restore']);