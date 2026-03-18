<?php

namespace App\Service; 
use Exception;

abstract class BaseService{

    protected function arrReturn(bool $status, ?array $data = null){
        return [
            "status"=>$status,
            "debug_msg"=>$this->isTrue($status),
            "data"=> $data ?? ["msg"=>"if empty ignore"]
        ];
    }
    protected function isArr(array $arr){
        if(is_array($arr)){return true;} return false;
    }
    protected function isTrue(bool $bool){
        if($bool){
            return "request_completed";
        }
        return "request_err";
    }
}

?>