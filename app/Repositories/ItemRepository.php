<?php

namespace App\Repositories;

use App\Models\ItemEntity;
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
    // public fun
}


?>