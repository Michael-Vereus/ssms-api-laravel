<?php
namespace App\DTOs;

use Illuminate\Http\Request;
readonly class BinDTO{
    public function __construct(
        public ?string $binId = null,
        public string $binName,
        public int $binCap
    ){}

    public static function fromRequest(Request $request): self{
        $binId = $request->input('binId');
        return new self(
            binId : is_null($binId) ? null : (string) $binId,
            binName : (string) $request->input('binName'),
            binCap : (int) $request->input('binCap')
        );
    }
}

?>