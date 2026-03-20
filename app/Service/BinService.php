<?php

namespace App\Service;

use App\Repositories\BinRepository;

class BinService extends BaseService {
    private $binRepo;
    public function __construct() {
        $this->binRepo = new BinRepository();
    }
    public function test(): array{

        $data = $this->binRepo->test();
        return $this->arrReturn(
            true,
            $data
        );
    }
}

?>