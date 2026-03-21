<?php

namespace App\Repositories;

use App\Models\ItemEntity;
use Arr;
use Exception;
use Illuminate\Support\Facades\DB;

class ItemRepository extends BaseRepository{
    protected $db;
    
    public function __construct() {
        // to get pdo instance
        $this->db = DB::connection()->getPdo();
    }
    public function fetchAll(): array {
        $itemFetched = [];
        $err_msg = $this->defaultErr;
        try {
            $itemFetched = ItemEntity::all()->toArray();
        } catch (Exception $e) {
            $err_msg = $this->$e->getMessage();
        }
        return $this->handleReturnArr(
            $itemFetched,
            $err_msg
        );
    }
    public function insertUno(ItemEntity $newItem): array {
        $status = $this->defaultStatus;
        $err_msg = $this->defaultErr;
        try {
            $status = $newItem->save();
        } catch (Exception $e) {
            $err_msg = $e->getMessage();
        }
        return $this->handleReturnArr(
            $status,
            $err_msg
        );
    }

    public function updateUno(ItemEntity $newItem): array{
        $status = $this->defaultStatus;
        $id = $newItem->itemId;
        $err_msg = $this->defaultErr;
        $search_item = ItemEntity::find($id);
        if($search_item){
            try {
                $newItem->exists = true;
                $status = $newItem->save();
            } catch (Exception $e) {
                $err_msg = $e->getMessage();
            }
        }
        return $this->handleReturnArr(
            $status,
            $err_msg
        );
    }
    public function deleteById(array $itemId): array{
        $status = $this->defaultStatus;
        $err_msg = $this->defaultErr;
        try {
            ItemEntity::destroy($itemId);
            $status = true;
        } catch (Exception $e) {
            $err_msg = $e->getMessage();
        }
        return $this->handleReturnArr(
            $status,
            $err_msg
        );
    }
    public function queryByName(string $name): array{
        $searchResult = [];
        $err_msg = $this->defaultErr;
        try {
            $searchResult =  ItemEntity::whereRaw(
                'LOWER(itemName) LIKE ?', 
                ['%' . strtolower($name) . '%']
            )->get()->toArray();
        } catch (Exception $e) {
            $err_msg = $e->getMessage();
        }
        return $this->handleReturnArr(
            $searchResult,
            $err_msg
        );
    }
}


?>