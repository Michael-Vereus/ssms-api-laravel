<?php

namespace App\Repositories;
use App\Models\BinEntity;
use Exception;
use Illuminate\Support\Facades\DB;
class BinRepository extends BaseRepository{
    protected $db;

    public function __construct() {
        $this->db = DB::connection()->getPdo();
    }
    public function all(): array{
        $result = BinEntity::all()->toArray();
        return $result;
    }
    public function insertUno(BinEntity $newBin): bool{
        $status = false;
        try {
            $status = $newBin->save();
        } catch (Exception $e) {
            $status = $this->defaultStatus;
        }
        return $status;
    }
}

?>