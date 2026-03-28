<?php

namespace App\Repositories;

use App\DTOs\RepoResponse;
use App\Models\ItemEntity;
use Arr;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\DB;

class ItemRepository extends BaseRepository{
    protected $db;
    
    public function __construct() {
        // to get pdo instance
        $this->db = DB::connection()->getPdo();
    }
    public function fetchAll(): RepoResponse {
        $status = $this->defaultStatus;
        $itemFetched = [];
        $err_msg = $this->defaultErr;
        try {
            $itemFetched = ItemEntity::all()->toArray();
            $status = true;
        } catch (Exception $e) {
            $err_msg = $this->$e->getMessage();
        }

        return new RepoResponse($status, $err_msg, $itemFetched);
    }
    public function insertUno(ItemEntity $newItem): RepoResponse {
        $status = $this->defaultStatus;
        $err_msg = $this->defaultErr;
        try {
            $status = $newItem->save();
        } catch (Exception $e) {
            $err_msg = $e->getMessage();
        }

        return new RepoResponse($status,$err_msg);
    }

    public function updateUno(ItemEntity $newItem): RepoResponse{
        $status = $this->defaultStatus;
        $id = $newItem->itemId;
        $err_msg = $this->defaultErr;
        $search_item = ItemEntity::find($id);
        if($search_item){
            try {
                $newItem->exists = true;
                $status = $newItem->save();
            } catch (Exception $e) {
                $err_msg = $e->getMessage();
            }
        }

        return new RepoResponse($status,$err_msg);
    }
    public function deleteById(array $itemId): RepoResponse{
        $status = $this->defaultStatus;
        $err_msg = $this->defaultErr;
        try {
            ItemEntity::destroy($itemId);
            $status = true;
        } catch (Exception $e) {
            $err_msg = $e->getMessage();
        }

        return new RepoResponse($status,$err_msg);
    }
    public function queryByName(string $name): RepoResponse{
        $status = $this->defaultStatus;
        $searchResult = [];
        $err_msg = $this->defaultErr;
        try {
            $searchResult =  ItemEntity::whereRaw(
                'LOWER(itemName) LIKE ?', 
                ['%' . strtolower($name) . '%']
            )->get()->toArray();
            $status = true;
        } catch (Exception $e) {
            $err_msg = $e->getMessage();
        }
        
        return new RepoResponse($status, $err_msg,$searchResult);
    }
}


?>