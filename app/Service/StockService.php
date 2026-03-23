<?php

namespace App\Service;

use App\DTOs\ServiceResponse;
use App\Repositories\StockRepository;



class StockService extends BaseService{
    private StockRepository $stockRepo ;
    public function __construct() {
        $this->stockRepo = new StockRepository();
    }
    public function test(): array{
        $data = $this->stockRepo->test();
        return $data;
    }
    public function fetchAll(): ServiceResponse{
        $data = $this->stockRepo->all();
        return ServiceResponse::fromRepoResponse($data);
    }
}
?>