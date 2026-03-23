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
}
