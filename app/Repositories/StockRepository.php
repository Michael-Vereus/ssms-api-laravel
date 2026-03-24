<?php

namespace App\Repositories;

use App\DTOs\RepoResponse;
use App\Models\StockEntity;
use Exception;

class StockRepository extends BaseRepository{
    public function all(): RepoResponse{
        $status = $this->defaultStatus;
        $err = $this->defaultErr;
        $stock = [];
        try {
            $stock = StockEntity::fetchAll();
            $status = true;
        } catch (Exception $e) {
            $err = $e->getMessage();
            $stock = null;
        }
        return new RepoResponse($status,$err,$stock);
    }
    public function insertUno(StockEntity $newStock): RepoResponse{
        $status = $this->defaultErr;
        $err_msg = $this->defaultStatus;
        try {
            $status = $newStock->save();
        } catch (Exception $e) {
            $err_msg = $e->getMessage();
        }
        return new RepoResponse($status, $err_msg);
    }
    public function checkCurrentQuantity(string $itemId, string $binId): int{
        return (int) StockEntity::where('binId', $binId)
        ->where('itemId', $itemId)
        ->sum('quantity');
    }
    public function queryByName(){}
    public function deleteById(){}
}
?>