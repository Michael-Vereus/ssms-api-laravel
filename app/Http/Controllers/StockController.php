<?php

namespace App\Http\Controllers;

use App\DTOs\StockDTO;
use App\Service\StockService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StockController extends Controller{
    private StockService $stockServ;
    public function __construct() {
        $this->stockServ = new StockService();
    }
    public function test(): JsonResponse{
        return $this->returnInJson($this->stockServ->test());
    }
    public function fetchAll(): JsonResponse{
        return response()->json($this->stockServ->getAll());
    }
    public function push(Request $request){
        $request->validate([
            'stockId' => 'prohibited',
            'binId' => 'required|string',
            'itemId' => 'required|string',
            'quantity' => 'required|int'
        ]);
        $newStock = StockDTO::fromRequest($request);
        return response()->json($this->stockServ->insertion($newStock));
    }
    public function patch(){}
    public function remove(){}
    public function search(){}
}
