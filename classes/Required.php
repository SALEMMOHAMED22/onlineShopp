<?php
namespace onlineShop\classess;


require_once "validator.php";
use onlineShop\classess\validator;

class Required implements validator{

    public function check($key, $value)
    {
        if(empty($value)){
            return "$key is required ";

        }else{
            return false;
        }
    }

}