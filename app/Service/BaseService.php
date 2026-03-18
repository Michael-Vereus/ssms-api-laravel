<?php

namespace App\Service; 
use Exception;

abstract class BaseService{
    public function arrReturn(bool $status, ?array $data){
        return [
            "status"=>$status,
            "debug_msg"=>$this->isTrue($status),
            "data"=> $data ?? ["msg"=>"empty"]
        ];
    }
    public function isArr(array $arr){
        if(is_array($arr)){return true;} return false;
    }
    public function isTrue(bool $bool){
        if($bool){
            return "request_completed";
        }
        return "request_err";
    }
    public function handleExcept(Exception $e){
        return [
            "msg"=>"db_err", 
            "err"=> $e->getMessage()
        ];
    }
}

?>