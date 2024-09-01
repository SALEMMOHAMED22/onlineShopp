<?php
namespace onlineShop\classess;

class IsNumber implements validator{

    public function check($key, $value)
    {
        if(! is_numeric($value)){

            return "$key must be number";
        }else{
            return false;
        }
    }
}