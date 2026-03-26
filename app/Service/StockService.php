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
                        // another note for myself need to add a check  
                        // if the quantity is sufficient for 'OUT' transaction

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
        return \DB::transaction(function() use ($outDTO){
            try {
            $stockExist = $this->stockRepo->findStockByBinAndItemId($outDTO->binId, $outDTO->itemId);
            if(is_null($stockExist)){throw new Exception("Stock doesnt exist");}
            $entity = StockService::newStockEntityFromArray($stockExist);
            $stockId = (string)$entity->getIdForLog();
            $this->emptyOldBin($entity);
            $repo = $this->stockRepo->insertStockIdOut(outStock::logBalanceOut($stockId));
            return ServiceResponse::fromRepoResponse($repo);
        } catch (Exception $e) {
            $err = $e->getMessage();
            return ServiceResponse::catchException($err);
        }
        });

    }
    public function restoreBalance(): ServiceResponse{
        // get the latest transaction of latestTransaction (binId, itemId, stockId, quantity, created_at)
        $check = $this->stockRepo->checkLastestTransaction("b81b46","722100ee");
        // get the latest out transaction (stockId and created_at)
        $checkLastestOut = $this->stockRepo->checkLast("b81b46","722100ee");
        // set default status
        $status = false;
        // return ServiceResponse::debugMode([$checkLastestOut]); --> debug mode ignore !
        // check if the total quantity is bigger than zero 
        // and checks if the latest transaction created_at date is newer than out_transaction created_at date
        if($check['total_quantity'] > 0 && $check['latest_created_at'] > $checkLastestOut['latest_out'] ){
            $status = true; // this status means that restoration isnt needed because current stock isn't at ZERO 0
        }
        try {
            // if true then js throw an Exception
            if($status){throw new Exception("Stock is already above zero no restoration required");}
            // if false then just procees to the restoration part
            $restoreBalance = StockEntity::makeNew(
                null,
                $checkLastestOut['binId'],
                $checkLastestOut['itemId'],
                $checkLastestOut['quantity'] + (-2)*$checkLastestOut['quantity']
            );
            $repoResp =  $this->stockRepo->insertUno($restoreBalance);
            return ServiceResponse::fromRepoResponse($repoResp);    
        } catch (Exception $e) {
            return ServiceResponse::catchException($e->getMessage());
        }
        
        // return ServiceResponse::debugMode([$repoResp,$check,$checkLastestOut, "Check completion" => $status]);
    }
    private static function createStockEntity(StockDTO $stockDTO): StockEntity{
        return StockEntity::makeNew(
            $stockDTO->stockId,
            $stockDTO->binId,
            $stockDTO->itemId,
            $stockDTO->quantity
        );
    }
    private static function newStockEntityFromArray(array $arr): StockEntity{
        return StockEntity::makeNew(
            null,
            $arr["binId"],
            $arr["itemId"],
            $arr["total_quantity"]
        );
    }
    // helper function to empty stock in old bin
    private function emptyOldBin(StockEntity $oldStock): void{
        $oldStock->quantity = -$oldStock->quantity;
        $this->stockRepo->insertUno($oldStock);
    }
}
?>