<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
class BinRepository extends BaseRepository{
    protected $db;

    public function __construct() {
        $this->db = DB::connection()->getPdo();
    }
}

?>