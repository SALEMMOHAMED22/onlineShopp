<?php

namespace onlineShop\classess;
require_once 'validator.php';
use onlineShop\classess\validator;


class EmailCheck implements validator{

    public function check($key , $value){

        if(! filter_var($value , FILTER_VALIDATE_EMAIL)){

            return " inValid $key ";

        }else{
            return false;
            
        }

    }

}