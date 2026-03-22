<?php

namespace App\DTOs;

readonly class ServiceResponse{
    public function __construct(
        public bool $status,
        public string $debug_msg,
        public string $debug_err,
        public array $data
    ) {}
    public static function fromRepoResponse(RepoResponse $repoResponse): self{
        return new self(
            status : $repoResponse->status,
            debug_msg : $repoResponse->err_info,
            debug_err : $repoResponse->err_info,
            data : $repoResponse->result
        );
    }
}
?>