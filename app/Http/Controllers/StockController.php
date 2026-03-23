<?php

namespace App\Http\Controllers;

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
        return response()->json($this->stockServ->fetchAll());
    }
    public function push(){}
    public function patch(){}
    public function remove(){}
    public function search(){}
}
