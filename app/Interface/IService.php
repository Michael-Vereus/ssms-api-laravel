<?php

namespace App\Interface;
use Illuminate\Http\Request;

interface IService{
    private function requestToArray(Request $request): array;
}


?>