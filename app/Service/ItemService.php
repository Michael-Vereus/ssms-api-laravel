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
        $data = $request->only(['itemId' , 'itemName', 'itemPrice']);
        
        $newItem = ItemEntity::makeNew(
            $data['itemId'] ?? null,
            $data['itemName'],
            $data['itemPrice']
        );
        $status = $this->itemRepo->insertUno($newItem);
        return $this->arrReturn(
            $status
        );
    }
    
}

?>