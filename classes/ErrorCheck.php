<?php

namespace onlineShop\classess;

class ErrorCheck implements validator{

    public function check($key , $error){
    if($error !=0){
        return "$key is required";
    }else{
        return false;
        
    }

    }
}