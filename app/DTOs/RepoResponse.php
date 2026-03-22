<?php

namespace App\DTOs;

readonly class RepoResponse{

    public function __construct(
        public bool $status,
        public array $result,
        public string $err_info
    ) {}
}

?>