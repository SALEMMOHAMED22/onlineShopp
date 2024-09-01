<?php 
namespace onlineShop\classess ;


require_once 'Required.php';
require_once 'Str.php';
require_once 'IsNumber.php';
require_once 'SizeCheck.php';
require_once 'ErrorCheck.php';
require_once 'ExtCheck.php';
require_once 'EmailCheck.php';




class Validation {
    public $errors = [];
    public function endValidation($key , $value , $rules){

        foreach ($rules as $rule ){
            $rule =  "onlineShop\classess\\" . $rule ;
            $obj = new $rule;
            $result = $obj->check($key , $value);
            if($result != false){
                $this->errors[] = $result;
            }
        }
    }

    public function getError(){
        return $this->errors;

    }
}