<?php

namespace App\Service;

use App\DTOs\BinDTO;
use App\DTOs\ServiceResponse;
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
    public function fetchAll(): ServiceResponse{
        $data = $this->binRepo->all();
        return ServiceResponse::fromRepoResponse($data);
    }
    public function insertion(BinDTO $binDTO): ServiceResponse{
        $newBin = $this->createBinEntity($binDTO);

        $data = $this->binRepo->insertUno($newBin);
        return ServiceResponse::fromRepoResponse($data);
    }
    public function destroy(array $deleteIds): ServiceResponse{
        $data = $this->binRepo->deleteById($deleteIds);

        return ServiceResponse::fromRepoResponse($data);
    }
    public function update(BinDTO $dto): ServiceResponse{
        $updtBin = $this->createBinEntity($dto);

        $data = $this->binRepo->updateUno($updtBin);
        return ServiceResponse::fromRepoResponse($data);
    }
    public function findItemByName(string $item_name): ServiceResponse{
        $data = $this->binRepo->queryByName($item_name);

        return ServiceResponse::fromRepoResponse($data);
    }
    private function createBinEntity(BinDTO $dto): BinEntity{
        return BinEntity::makeNew(
            $dto->binId,
            $dto->binName,
            $dto->binCap
        );
    }
}

?>