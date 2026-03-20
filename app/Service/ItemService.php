<?php

namespace App\Service;

use App\DTOs\ItemDTO;
use App\Interface\IService;
use App\Models\ItemEntity;
use App\Repositories\ItemRepository;
use Illuminate\Http\Request;

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
    
    public function findItemByName(string $item_name): array{
        if(!$item_name || strlen($item_name) < 3){
            return $this->arrReturn(
                false,
                ["Enter at least 3 characters to search"]
            );
        }

        $data = $this->itemRepo->queryByName($item_name);

        return $this->arrReturn(
            $this->isArr($data),
            $data
        );
    }
    
    public function insertion(ItemDTO $dto): array{
        if($dto->itemPrice <= 0){
            return $this->arrReturn(
                false,
                ["Invalid Item Price"]
            );
        }
        $newItem = $this->createItemEntity($dto);
        $status = $this->itemRepo->insertUno($newItem);

        return $this->arrReturn(
            $status
        );
    }
    public function update(ItemDTO $dto): array{

        $uptItem = $this->createItemEntity($dto);
        $status = $this->itemRepo->updateUno($uptItem);
    
        return $this->arrReturn(
            $status
        );
    }
    public function destroy(array $deleteIds): array{
        $status = $this->itemRepo->deleteById($deleteIds);
        
        return $this->arrReturn(
            $status
        );
    }

    // helper class
    // private function requestToArray(Request $request): array{
    //     return $request->only([
    //         'itemId' , 
    //         'itemName', 
    //         'itemPrice'
    //     ]);
    // }
    private function createItemEntity(ItemDTO $dto): ItemEntity{
        return ItemEntity::makeNew(
            $dto->itemId,
            $dto->itemName,
            $dto->itemPrice
        );
    }
    
}

?>