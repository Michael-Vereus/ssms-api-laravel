<?php

namespace App\DTOs;

readonly class ServiceResponse{
    public function __construct(
        public bool $status,
        public string $debug_msg,
        public string $debug_err,
        public ?array $data
    ) {}
    public static function fromRepoResponse(RepoResponse $repoResponse): self{
        return new self(
            status : $repoResponse->status,
            debug_msg : ServiceResponse::getDebugMsg($repoResponse->result),
            debug_err : $repoResponse->err_info,
            data : $repoResponse->result
        );
    }
    private static function getDebugMsg(?array $data): string{
        if(is_null($data)){return "Request doesnt return any data";}
        elseif ($data === []) {
            return "No Such stock EXIST in DB !!!";
        }
        return "Request Completed with data";
    }
    public static function catchException(string $err_msg){
        return new self(
            true,
            ServiceResponse::getDebugMsg(null),
            $err_msg,
            null
        );
    }
    public static function debugMode(mixed $data): self{
        return new self(
            false,
            "debug mode",
            "-",
            $data
        );
    }
}
?>