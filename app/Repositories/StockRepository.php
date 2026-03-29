<?php

namespace App\Repositories;

use App\DTOs\RepoResponse;
use App\Models\BinEntity;
use App\Models\outStock;
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
    public function insertStockIdOut(outStock $outStock): RepoResponse{
        $status = $this->defaultErr;
        $err_msg = $this->defaultStatus;
        try {
            $status = $outStock->save();
        } catch (Exception $e) {
            $err_msg = $e->getMessage();
        }
        return new RepoResponse($status, $err_msg);
    }
    // to only be used as a helper functio !!! 
    public function findStockByBinAndItemId(string $binId, string $itemId): array|null{
        $stock = [];
        try {
            $stock = StockEntity::select('binId', 'itemId')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->where('binId', $binId)
            ->where('itemId', $itemId)
            ->groupBy('binId', 'itemId')
            ->first()
            ?->toArray();
        } catch (Exception $e) {
            $stock = [$e->getMessage()];
        }
        return $stock;
    }
    public function checkLastestTransaction(string $binId,string $itemId){
        $stock = [];
        try {
            $stock = StockEntity::select('binId', 'itemId')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->selectRaw('MAX(created_at) as latest_created_at')
            ->where('binId', $binId)
            ->where('itemId', $itemId)
            ->groupBy('binId', 'itemId')
            ->first()
            ?->toArray();
        } catch (Exception $e) {
            $stock = [$e->getMessage()];
        }
        return $stock;
    }
    public function checkLast(string $binId, string $itemId){
        $stock = [];
        try {
            $stock = outStock::select(
                'stock_log.itemId',
                'stock_log.binId',
                'out_stock_log.stockId',
                'stock_log.quantity'
            )
            ->selectRaw('MAX(out_stock_log.created_at) as latest_out')
            ->join('stock_log', 'out_stock_log.stockId', '=', 'stock_log.stockId')
            ->where('stock_log.binId', $binId)
            ->where('stock_log.itemId',$itemId)
            ->groupBy('stock_log.binId','stock_log.itemId')
            ->first()
            ?->toArray();
        } catch (Exception $e) {
            $stock = [$e->getMessage()];
        }
        if (is_null($stock)){return [null];}
        return $stock;
    }
    public function getBinCapacity(string $binId): mixed{
        try {
            $quantity = BinEntity::where('binId', $binId)->value('binCap');
        } catch (Exception $e) {
            $quantity = $e->getMessage();
        }
        return $quantity;
    }
}
?>