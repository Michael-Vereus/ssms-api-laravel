<?php

namespace App\DTOs;

readonly class RepoResponse{

    public function __construct(
        public bool $status,
        public string $err_info,
        public ?array $result = null
    ) {}
}

?>