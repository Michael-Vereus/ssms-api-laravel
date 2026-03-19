<?php

namespace App\Repositories;

use App\Models\ItemEntity;
use Arr;
use Exception;
use Illuminate\Support\Facades\DB;

class ItemRepository extends BaseRepository{
    
    public function __construct() {
        // to get pdo instance
        $this->db = DB::connection()->getPdo();
    }
    public function fetchAll(): array {
        $itemFetched = [];
        try {
            $itemFetched = ItemEntity::all()->toArray();
        } catch (Exception $e) {
            $itemFetched = $this->handleExcept($e);
        }
        return $itemFetched;
    }
    public function insertUno(ItemEntity $newItem): bool {
        $status = $this->defaultStatus;
        try {
            $status = $newItem->save();
        } catch (Exception $e) {
            $status;
        }
        return $status;
    }

    public function updateUno(ItemEntity $newItem, string $itemId): bool{
        $status = $this->defaultStatus;
        $id = $newItem->itemId;
        $search_item = ItemEntity::find($id);
        if($search_item){
            try {
                $newItem->exists = true;
                $status = $newItem->save();
            } catch (Exception $e) {
                $status;
            }
        }
        return $status;
    } 
}


?>