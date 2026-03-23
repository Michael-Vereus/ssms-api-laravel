<?php

namespace App\Http\Controllers;

use App\DTOs\ItemDTO;
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
            'itemId' => 'prohibited',
            'itemPrice'   => 'required|integer',
            'itemName' => 'required|string',
        ]);
        $newItem = ItemDTO::fromRequest($request);
        return $this->returnInJson($this->itemServ->insertion($newItem));
    }
    public function patch(Request $request): JsonResponse{
        $request->validate([
            'itemPrice'   => 'required|integer',
            'itemName' => 'required|string',
        ]);
        $updtItem = ItemDTO::fromRequest($request);
        return $this->returnInJson($this->itemServ->update($updtItem));
    }
    public function remove(Request $request): JsonResponse{
        $request->validate([
            'itemId'=>'required|array'
        ]);
        $ids = $request->itemId;
        return $this->returnInJson($this->itemServ->destroy($ids));
    }
    public function search(string $item_name): JsonResponse{
        return $this->returnInJson($this->itemServ->findItemByName($item_name));
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
}
