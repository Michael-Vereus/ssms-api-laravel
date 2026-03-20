<?php

namespace App\Http\Controllers;

use App\Service\BinService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BinController extends Controller {
    private $binServ;
    public function __construct() {
        $this->binServ = new BinService();
    }
    public function test(): JsonResponse{
        return response()->json($this->binServ->test());
    }
    public function fetchAll(): JsonResponse{
        return $this->returnInJson($this->arrForTest());
    }

}
