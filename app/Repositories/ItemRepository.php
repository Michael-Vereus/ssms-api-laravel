<?php

namespace App\Repositories;

use App\Models\ItemEntity;
use Illuminate\Database\Eloquent\Collection;

class ItemRepository {
    public function getAll(): Collection {
        return ItemEntity::all();
    }
}


?>