<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
abstract class Controller{
    protected function returnInJson(array $toJson): JsonResponse{
        return response()->json($toJson);
    }
    protected function arrForTest(): array{
        return ["this is a test array"];
    }
} 
