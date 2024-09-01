<?php

namespace onlineShop\classess;

class ExtCheck implements validator{
    private $arr_ext = ['png' , 'jpg'  , 'jpeg' , 'gif'];
    public function check($key , $value){
        if(! in_array($value , $this->arr_ext)){
            return "$key not correct";

        }else{
            return false;
        }

    }
}