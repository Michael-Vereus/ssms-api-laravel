<?php

namespace App\Service;
use function PHPUnit\Framework\returnArgument;
use Illuminate\Support\Facades\DB;

class ItemService {
    protected $db;
    public function __construct() {
        // This gives you the underlying PDO instance if you really need it
        $this->db = DB::connection()->getPdo();
    }
    public function test(): array{
        $query = $this->db->query("SELECT sqlite_version()");
        $version = $query->fetchColumn();
        return [
            "msg"=>"Item API is running",
            "sqlite_ver"=> $version
        ];
    }
}

?>