<?php

namespace onlineShop\classess;

class SizeCheck implements validator{

    public function check($key, $value)
    {
        if($value > 1){
            return "$key size must be less than 1 MB";
        }else{
            return false;
        }
    }
}
