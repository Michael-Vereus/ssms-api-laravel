<?php

namespace App\Service;

use App\Models\ItemEntity;
use App\Repositories\ItemRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemService extends BaseService{
    protected ItemRepository $itemRepo ;
    public function __construct() {
        $this->itemRepo = new ItemRepository();
    }
    public function test(): array{
        return $this->itemRepo->test();
    }
    public function getAll(): array{
        $all = $this->itemRepo->fetchAll();

        return $this->arrReturn(
            $this->isArr($all),
            $all
        );
    }
    public function insertion(Request $request): array{
        $data = $this->requestToArray($request);
        
        $newItem = $this->createItemEntity($data);
        $status = $this->itemRepo->insertUno($newItem);
        return $this->arrReturn(
            $status
        );
    }
    public function update(Request $request): array{
        $data = $this->requestToArray($request);

        $uptItem = $this->createItemEntity($data);
        $status = $this->itemRepo->updateUno($uptItem, $data['itemId']);
        return $this->arrReturn(
            $status
        );
    }

    // helper class
    private function requestToArray(Request $request): array{
        return $request->only([
            'itemId' , 
            'itemName', 
            'itemPrice'
        ]);
    }
    private function createItemEntity(array $data): ItemEntity{
        return ItemEntity::makeNew(
            $data['itemId'] ?? null,
            $data['itemName'],
            $data['itemPrice']
        );
    }
    
}

?>