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
        $result = [];
        $err_msg = $this->defaultErr;
        try {
            $result = BinEntity::all()->toArray();    
        } catch (Exception $e) {
            $err_msg = $e->getMessage();
        }
        
        return $this->handleReturnArr(
            $result,
            $err_msg
        );
    }
    public function insertUno(BinEntity $newBin): array{
        $status = $this->defaultStatus;
        $err_msg = $this->defaultErr;
        try {
            $status = $newBin->save();
        } catch (Exception $e) {
            $err_msg = $e->getMessage();
        }
        return $this->handleReturnArr(
            $status,
            $err_msg
        );
    }
    public function deleteById(array $binId): array{
        $status = $this->defaultStatus;
        $err_msg = null;
        try {
            BinEntity::destroy($binId);
            $status = $this->successStatus;
        } catch (Exception $e) {
            $err_msg = $e->getMessage();
        }
        return $this->handleReturnArr(
            $status,
            $err_msg
        );
    }
    // public function updateUno(BinEntity $updtBin):array{

    // }
}

?>