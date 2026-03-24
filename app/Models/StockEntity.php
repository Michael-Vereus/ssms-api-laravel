<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockEntity extends Model{
    protected $table = 'stock_log';
    protected $primaryKey = 'stockId';
    protected $keyType = 'string';
    protected $fillable = [
        'stockId',
        'binId',
        'itemId',
        'quantity'
    ];
    public static function makeNew(?string $stockId = null, string $binId, string $itemId, int $quantity): self{
        $stock = new self();
        $stock->stockId = $stockId ?? self::calculateId();
        $stock->binId = $binId;
        $stock->itemId = $itemId;
        $stock->quantity = $quantity;
        return $stock;
    }
    private static function calculateId(): string{
        $stockId = bin2hex(random_bytes(5));
        return $stockId;
    }
    public static function fetchAll(): array{
        return StockEntity::select(
            'stock_log.itemId', 
            'stock_log.binId', 
            'items.itemName', 
            'bins.binName'
        )
        ->selectRaw('SUM(stock_log.quantity) as total_quantity')
        ->join('items', 'stock_log.itemId', '=', 'items.itemId')
        ->join('bins', 'stock_log.binId', '=', 'bins.binId')
        ->groupBy('stock_log.itemId', 'stock_log.binId', 'items.itemName', 'bins.binName')
        ->get()
        ->toArray();
    }
}
