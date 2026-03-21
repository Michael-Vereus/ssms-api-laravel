<?php

namespace App\Service;

use App\DTOs\BinDTO;
use App\Models\BinEntity;
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
    public function fetchAll(): array{
        $data = $this->binRepo->all();
        return $this->arrReturn(
            $this->isArr($data),
            $data
        );
    }
    public function insertion(BinDTO $binDTO): array{
        $newBin = $this->createBinEntity($binDTO);

        return [$newBin];
        $status = $this->binRepo->insertUno($newBin);
        return $this->arrReturn(
            $status
        );
    }
    public function createBinEntity(BinDTO $dto): BinEntity{
        return BinEntity::makeNew(
            $dto->binId,
            $dto->binName,
            $dto->binCap
        );
    }
}

?>