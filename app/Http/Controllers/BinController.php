<?php

namespace App\Http\Controllers;

use App\DTOs\BinDTO;
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
        return $this->returnInJson($this->binServ->fetchAll());
    }
    public function push(Request $request): JsonResponse{
        $request->validate([
            "binId"=>'prohibited',
            'binName'=> 'required|string',
            'binCap'=>'required|integer'
        ]);
        $newBin = BinDTO::fromRequest($request);
        // return $this->returnInJson(["msg"=>$newBin]);
        return $this->returnInJson($this->binServ->insertion($newBin));
    }

}
