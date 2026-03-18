<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemEntity extends Model {
    protected $table = 'items';
    protected $primaryKey = 'id';
    private $inrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'itemId',
        'itemName',
        'itemPrice'
    ];

}
