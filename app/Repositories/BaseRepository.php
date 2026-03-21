<?php 

namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;


abstract class BaseRepository {
    protected $db;
    protected bool $defaultStatus = false;
    protected bool $successStatus = true;
    protected string $defaultErr = "none";
    protected function handleExcept(Exception $e){
        return [
            "msg"=>"db_err", 
            "err"=> $e->getMessage()
        ];
    }
    public function test(): array{
        $query = $this->db->query("SELECT sqlite_version()");
        $version = $query->fetchColumn();
        return [
            "msg"=>"DB API is running",
            "sqlite_ver"=> $version
        ];
    }
    public function handleReturnArr(bool|array $result, string $error): array{
        return [
            "result"=>$result,
            "debug_err"=>$error
        ];
    }
}

?>