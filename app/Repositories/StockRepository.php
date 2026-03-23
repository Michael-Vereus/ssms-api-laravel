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
            $stock = StockEntity::all()->toArray();
            $status = true;
        } catch (Exception $e) {
            $err = $e->getMessage();
            $stock = null;
        }
        return new RepoResponse($status, $stock, $err);
    }
    public function insertUno(){}
    public function updateUno(){}
    public function queryByName(){}
    public function deleteById(){}
}
?>