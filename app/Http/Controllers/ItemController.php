<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Service\ItemService;

class ItemController extends Controller {

    private ItemService $itemServ;

    public function __construct(ItemService $itemService) {
        $this->itemServ = new ItemService();
    }
    public function test() {
        return $this->returnInJson($this->itemServ->test());
    }
    public function fetchAll(): JsonResponse {
        return $this->returnInJson($this->itemServ->getAll());
    }
    public function push(Request $request): JsonResponse {
        //to check if this key exist in json 
        $request->validate([
            'itemPrice'   => 'required|int',
            'itemName' => 'required|string',
        ]);
        return $this->returnInJson($this->itemServ->insertion($request));
    }
    /*public function createItem(): JsonResponse{
        return   
    }
    
    private function toJsonArr(array $arr){
        
    }

    /*
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */ /*
    public function show(string $id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     */ /*
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */ /*
    public function destroy(string $id)
    {
        //
    } */
    private function returnInJson(array $toJson): JsonResponse{
        return response()->json($toJson);
    }
    
}
