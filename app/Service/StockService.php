<?php

namespace App\Service;

use App\DTOs\ServiceResponse;
use App\DTOs\StockDTO;
use App\Models\outStock;
use App\Models\StockEntity;
use App\Repositories\StockRepository;
use Exception;



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
        $newStock = self::createStockEntity($stockDTO);
        $data = $this->stockRepo->insertUno($newStock);
        return ServiceResponse::fromRepoResponse($data);
    }
    public function handleUpdateStock(StockDTO $updateStockDTO): ServiceResponse{
        return \DB::transaction(function() use ($updateStockDTO){
            try {
                switch ($updateStockDTO->action) {
                    case 'IN':
                        $res = $this->insertion($updateStockDTO);
                        break;

                    case 'OUT':
                        // We flip the quantity to negative for a removal
                        $negativeDTO = $updateStockDTO->withNegativeQuantity();
                        $res = $this->stockRepo->insertUno(self::createStockEntity($negativeDTO));
                        break;

                    case 'TRANSFER':
                        //get current stock from db
                        $curentStock = $this->stockRepo->checkCurrentQuantity(
                            $updateStockDTO->itemId,
                            $updateStockDTO->binId
                        );
                        // check if current stock smoller than incoming changes
                        if($curentStock < $updateStockDTO->quantity){
                            throw new Exception("Unable to move stock due to your !Current Stock : $curentStock is smaller than {$updateStockDTO->quantity}!");
                        }
                        // empty old bin 
                        $sourceStock = self::createStockEntity($updateStockDTO);
                        $this->emptyOldBin($sourceStock);
                        // transfer it to the new bin
                        $destStock = StockEntity::makeNew(
                            null, // New ID
                            $updateStockDTO->newBinId,
                            $updateStockDTO->itemId,
                            $updateStockDTO->quantity
                        );
                        $res = $this->stockRepo->insertUno($destStock);
                        break;

                    default:
                        throw new Exception("Unknown movement type, mate!");
                }
                if ($res instanceof ServiceResponse){return $res;}
                return ServiceResponse::fromRepoResponse($res);
            } catch (Exception $e) {
                $err = $e->getMessage();
                return ServiceResponse::catchException($err);
            }
        });
    }
    public function balanceOut(StockDTO $outDTO): ServiceResponse{
        // $outStock =  self::createStockEntity($outDTO);
        $checkOut = outStock::logBalanceOut("b9a89dc3b5");
        $check = $this->stockRepo->insertStockIdOut($checkOut);
        return ServiceResponse::debugMode([$checkOut, $check]);
        // return \DB::transaction(function() use ($outDTO){
        //     try {
        //         $outStock =  self::createStockEntity($outDTO);
        //         $this->emptyOldBin($outStock);
        //         $stockId = $outStock->stockId;
        //         $repo = $this->stockRepo->insertStockIdOut(outStock::logBalanceOut($stockId));
        //         return ServiceResponse::fromRepoResponse($repo);
        //     } catch (Exception $e) {
        //         $err = $e->getMessage();
        //         return ServiceResponse::catchException($err);
        //     }
        // });

    }
    private static function createStockEntity(StockDTO $stockDTO): StockEntity{
        return StockEntity::makeNew(
            $stockDTO->stockId,
            $stockDTO->binId,
            $stockDTO->itemId,
            $stockDTO->quantity
        );
    }
    // helper function to empty stock in old bin
    private function emptyOldBin(StockEntity $oldStock): void{
        $oldStock->quantity = -$oldStock->quantity;
        $this->stockRepo->insertUno($oldStock);
    }
}
?>