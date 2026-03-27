<?php

namespace App\Service;

use App\DTOs\ItemDTO;
use App\DTOs\ServiceResponse;
use App\Models\ItemEntity;
use App\Repositories\ItemRepository;
use Exception;

class ItemService extends BaseService{
    protected ItemRepository $itemRepo ;
    public function __construct() {
        $this->itemRepo = new ItemRepository();
    }
    public function test(): array{
        return $this->itemRepo->test();
    }
    public function getAll(): ServiceResponse{
        $data = $this->itemRepo->fetchAll();

        return ServiceResponse::fromRepoResponse($data);
    }
    
    public function findItemByName(string $item_name): ServiceResponse{
        // if(!$item_name || strlen($item_name) < 3){
        //     return $this->arrReturn(
        //         false,
        //         "Enter at least 3 characters to search"
        //     );
        // }
        try {
            if(!$item_name || strlen($item_name) < 3){throw new Exception("Invalid item name please try again");}
            $data = $this->itemRepo->queryByName($item_name);
            return ServiceResponse::fromRepoResponse($data);
        } catch (Exception $e) {
            return ServiceResponse::catchException($e->getMessage());
        }
    }
    
    public function insertion(ItemDTO $dto): ServiceResponse{
        // if($dto->itemPrice <= 0){
        //     return $this->arrReturn(
        //         false,
        //         "Invalid Item Price"
        //     );
        // }
        try {
            if($dto->itemPrice <= 0){ throw new Exception("Invalid Item Price given !");}

            $newItem = $this->createItemEntity($dto);
            $data = $this->itemRepo->insertUno($newItem);['result'];
            return ServiceResponse::fromRepoResponse($data);
        } catch (Exception $e) {
            return ServiceResponse::catchException($e->getMessage());
        }
        
        // return $this->arrReturn(
        //     $data['result'],
        //     $data['debug_err']
        // );
    }
    public function update(ItemDTO $dto): ServiceResponse{

        try {
            if ($dto->itemPrice <= 0 || strlen($dto->itemName) < 3) {throw new Exception("Invalid item price");}
            $uptItem = $this->createItemEntity($dto);
            $data = $this->itemRepo->updateUno($uptItem);
            return ServiceResponse::fromRepoResponse($data);
        } catch (Exception $e) {
            return ServiceResponse::catchException($e->getMessage());
        }
        
        // return $this->arrReturn(
        //     $data['result'],
        //     $data['debug_err']
        // );
    }
    public function destroy(array $deleteIds): ServiceResponse{
        try {
            $data = $this->itemRepo->deleteById($deleteIds);
            return ServiceResponse::fromRepoResponse($data);
        } catch (Exception $e) {
            return ServiceResponse::catchException($e->getMessage());
        }

        // return $this->arrReturn(
        //     $data['result'],
        //     $data['debug_err']
        // );
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