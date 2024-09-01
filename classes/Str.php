<?php
namespace onlineShop\classess;
use onlineShop\classess\validator;
require_once "validator.php";


class Str implements validator{
    public function check($key, $value)
    {
        if(is_numeric($value)){
            return " $key must be string";
        }else{
            return false ; 
        }
    }
}