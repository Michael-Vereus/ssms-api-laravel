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
        return $data;
    }
    public function fetchAll(): array{
        $data = $this->binRepo->all();
        return $this->arrReturn(
            true,
            $data['debug_err'],
            $data['result']
        );
    }
    public function insertion(BinDTO $binDTO): array{
        $newBin = $this->createBinEntity($binDTO);

        $data = $this->binRepo->insertUno($newBin);
        return $this->arrReturn(
            $data['result'],
            $data['debug_err'],
        );
    }
    public function destroy(array $deleteIds): array{
        $data = $this->binRepo->deleteById($deleteIds);

        return $this->arrReturn(
            $data['result'],
            $data['debug_err']
        );
    }
    public function update(BinDTO $dto): array{
        $updtBin = $this->createBinEntity($dto);

        $data = $this->binRepo->updateUno($updtBin);
        return $this->arrReturn(
            $data['result'],
            $data['debug_err']
        );
    }
    public function findItemByName(string $item_name): array{
        $data = $this->binRepo->queryByName($item_name);

        return $this->arrReturn(
            true,
            $data['debug_err'],
            $data['result']
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