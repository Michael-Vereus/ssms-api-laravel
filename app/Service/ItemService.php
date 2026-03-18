<?php

namespace App\Service;
use App\Models\ItemEntity;
use Exception;
use Illuminate\Support\Facades\DB;

class ItemService extends BaseService{
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
    public function getAll(){
        $itemFetched = [];
        try {
            $itemFetched = ItemEntity::all()->toArray();
        } catch (Exception $e) {
            $itemFetched = $this->handleExcept($e);
        }
        return $this->arrReturn(
            $this->isArr($itemFetched),
            $itemFetched
        );
    }
    
}

?>