<?php

namespace App\DTOs;

use Illuminate\Http\Request;

readonly class StockDTO{
    public function __construct(
        public ?string $stockId = null,
        public string $binId,
        public string $itemId,
        public int $quantity
    ) {}
    public static function fromRequest(Request $request): self{
        $stockId = $request->input('stockId');
        return new self(
            stockId : is_null($stockId) ? null : (string) $stockId,
            binId : (string) $request->input('binId'),
            itemId : (string) $request->input('itemId'),
            quantity : (int) $request->input('quantity')
        );
    }
}

?>