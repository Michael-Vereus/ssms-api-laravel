<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class ItemDTO{
    public function __construct(
        public ?string $itemId = null,
        public string $itemName,
        public int $itemPrice
    ){}

    public static function fromRequest(Request $request):self{
        return new self(
            itemId : $request->input('itemId'),
            itemName : $request->input('itemName'),
            itemPrice : $request->input('itemPrice')
        );
    }
}

?>