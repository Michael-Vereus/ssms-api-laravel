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
        return $this->returnInJson($this->stockServ->getAll());
    }
    public function push(Request $request){
        $request->validate([
            'stockId' => 'prohibited',
            'binId' => 'required|string',
            'itemId' => 'required|string',
            'quantity' => 'required|int'
        ]);
        $newStock = StockDTO::fromRequest($request);
        // return $this->returnInJson($newStock);
        return $this->returnInJson($this->stockServ->insertion($newStock));
    }
    public function patch(Request $request){
        $request->validate([
            'stockId' => 'prohibited',
            'binId' => 'required|string',
            'itemId' => 'required|string',
            'quantity' => 'required|int',
            'newBinId' => 'optional|string',
            'action' => 'required|in:IN,OUT,TRANSFER'
        ]);
        $updateStock = StockDTO::fromRequest($request);
        return $this->returnInJson($this->stockServ->handleUpdateStock($updateStock));
    }
    public function remove(Request $request){
        $request->validate([
            'stockId' => 'prohibited',
            'binId' => 'required|string',
            'itemId' => 'required|string',
            'quantity' => 'prohibited'
        ]);
        $removeStock = StockDTO::fromRequest($request);
        return $this->returnInJson($this->stockServ->balanceOut($removeStock));
    }
    public function restore(Request $request){
        $request->validate([
            'stockId' => 'prohibited',
            'binId' => 'required|string',
            'itemId' => 'required|string',
            'quantity' => 'prohibited'
        ]);
        $restoreStock = StockDTO::fromRequest($request);
        return $this->returnInJson($this->stockServ->restoreBalance($restoreStock));
    }
}
