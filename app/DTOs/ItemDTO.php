<?php

namespace App\DTOs;

use Illuminate\Http\Request;

readonly class ItemDTO{
    public function __construct(
        public ?string $itemId = null,
        public string $itemName,
        public int $itemPrice
    ){}

    public static function fromRequest(Request $request):self{
        return new self(
            itemId : (string) $request->input('itemId'),
            itemName : (string) $request->input('itemName'),
            itemPrice : (int) $request->input('itemPrice')
        );
    }
}

?>