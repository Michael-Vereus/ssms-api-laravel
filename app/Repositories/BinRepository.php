<?php

namespace App\Repositories;
use App\DTOs\RepoResponse;
use App\Models\BinEntity;
use Exception;
use Illuminate\Support\Facades\DB;
class BinRepository extends BaseRepository{
    protected $db;

    public function __construct() {
        $this->db = DB::connection()->getPdo();
    }
    public function all(): RepoResponse{
        $status = $this->defaultStatus;
        $result = [];
        $err_msg = $this->defaultErr;
        try {
            $result = BinEntity::all()->toArray();
            $status = true;
        } catch (Exception $e) {
            $err_msg = $e->getMessage();
        }
        
        return new RepoResponse($status, $err_msg, $result);
    }
    public function insertUno(BinEntity $newBin): RepoResponse{
        $status = $this->defaultStatus;
        $err_msg = $this->defaultErr;
        try {
            $status = $newBin->save();
        } catch (Exception $e) {
            $err_msg = $e->getMessage();
        }

        return new RepoResponse($status,$err_msg);
    }
    public function deleteById(array $binId): RepoResponse{
        $status = $this->defaultStatus;
        $err_msg = $this->defaultErr;
        try {
            BinEntity::destroy($binId);
            $status = true;
        } catch (Exception $e) {
            $err_msg = $e->getMessage();
        }

        return new RepoResponse($status,$err_msg);
    }
    public function updateUno(BinEntity $updtBin): RepoResponse{
        $status = $this->defaultStatus;
        $err_msg = $this->defaultErr;
        $id = $updtBin->binId;
        $checkBin = BinEntity::find($id);
        if($checkBin){
            try {
                $updtBin->exists = true;
                $status = $updtBin->save();
            } catch (Exception $e) {
                $err_msg = $e->getMessage();
            }
        }
        
        return new RepoResponse($status, $err_msg);
    }
    public function queryByName(string $name): RepoResponse{
        $status = $this->defaultStatus;
        $search_bin = [];
        $err_msg = $this->defaultErr;
        try {
            $search_bin = BinEntity::whereRaw(
                'LOWER(binName) LIKE ?',
                ['%'. strtolower($name) . '%'])->get()->toArray();
            $status = false;
        } catch (Exception $e) {
            $err_msg = $e->getMessage();
        }
        
        return new RepoResponse($status, $err_msg, $search_bin);
    }
}

?>