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
    private function returnInJson(array $toJson): JsonResponse{
        return response()->json($toJson);
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
