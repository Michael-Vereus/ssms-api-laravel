<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class outStock extends Model
{
    protected $table = 'out_stock_log';
    // Inside your outStock model (and likely your stockLog model too)
    public $incrementing = false; // Tell Eloquent NOT to treat the ID as an auto-incrementing intx
    protected $keyType = 'string'; // Tell Eloquent the ID is a string
    protected $primaryKey = 'stockId'; // Ensure this matches your migration
    protected $fillable = [
        'stockId'
    ];
    public static function logBalanceOut(string $stockId): self{
        $log = new self();
        $log->stockId = $stockId;
        return $log;
    }
}
