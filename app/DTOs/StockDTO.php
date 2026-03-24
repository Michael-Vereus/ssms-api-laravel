<?php

namespace App\DTOs;

use Illuminate\Http\Request;

readonly class StockDTO{
    public function __construct(
        public ?string $stockId = null,
        public string $binId,
        public string $itemId,
        public int $quantity,
        public ?string $newBinId = null,
        public ?string $action = null,
    ) {}
    public static function fromRequest(Request $request): self{
        $stockId = $request->input('stockId');
        $newIID = $request->input('newItemId');
        $newBID = $request->input('newBinId');
        $action = $request->input('action');
        return new self(
            stockId : is_null($stockId) ? null : (string) $stockId,
            binId : (string) $request->input('binId'),
            itemId : (string) $request->input('itemId'),
            quantity : (int) $request->input('quantity'),
            newBinId : is_null($newBID) ? null : (string) $newBID,
            action : is_null($action) ? null : (string) $action
        );
    }
    public function toNegative(){
        $this->quantity = -$this->quantity;
    }
    public function withNegativeQuantity(): self
{
    return new self(
        stockId: $this->stockId,
        binId: $this->binId,
        itemId: $this->itemId,
        quantity: -$this->quantity, // The magic happens here
        newBinId: $this->newBinId,
        action: $this->action
    );
}
}

?>