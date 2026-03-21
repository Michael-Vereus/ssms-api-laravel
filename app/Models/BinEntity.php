<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BinEntity extends Model
{
    protected $table = 'bins';//
    protected $primaryKey = 'binId';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'binId',
        'binName',
        'binCap'
    ];

    public static function makeNew(?string $binId = null, string $binName, int $binCap): self{
        $bin = new self();
        $bin->binId = $binId ?? self::calculateId();
        $bin->binName = $binName;
        $bin->binCap = $binCap;
        return $bin;
    }
    public static function calculateId(): string{
        $binId = bin2hex(random_bytes(3));
        return $binId;
    }
}
