<?php

namespace App\Service;

use App\DTOs\ServiceResponse;
use App\DTOs\StockDTO;
use App\Models\StockEntity;
use App\Repositories\StockRepository;



class StockService extends BaseService{
    private StockRepository $stockRepo ;
    public function __construct() {
        $this->stockRepo = new StockRepository();
    }
    public function test(): array{
        $data = $this->stockRepo->test();
        return $data;
    }
    public function getAll(): ServiceResponse{
        $data = $this->stockRepo->all();
        return ServiceResponse::fromRepoResponse($data);
    }
    public function insertion(StockDTO $stockDTO): ServiceResponse{
        $newStock = $this->createStockEntity($stockDTO);
        $data = $this->stockRepo->insertUno($newStock);
        return ServiceResponse::fromRepoResponse($data);
    }
    private function createStockEntity(StockDTO $stockDTO): StockEntity{
        return StockEntity::makeNew(
            $stockDTO->stockId,
            $stockDTO->binId,
            $stockDTO->itemId,
            $stockDTO->quantity
        );
    }
}
?>