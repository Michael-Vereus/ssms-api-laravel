<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemEntity extends Model {
    protected $table = 'items';
    protected $primaryKey = 'itemId';
    private $inrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'itemId',
        'itemName',
        'itemPrice'
    ];

    public static function makeNew(?string $itemId = null, string $itemName, int $itemPrice) {
        $item = new self();
        $item->itemId = $itemId ?? self::calculateId();
        $item->itemName = $itemName;
        $item->itemPrice = $itemPrice;
        return $item;
    }
    private static function calculateId(){
        $itemId = bin2hex(random_bytes(4));
        return $itemId;
    }

}
