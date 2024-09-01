<?php

namespace onlineShop\classess;

class Password{



    public function hash($password){
       
        return password_hash($password , PASSWORD_DEFAULT);

    }

    public function verifyPassword($pass , $hashPass){

        return password_verify($pass , $hashPass);

    }

    
}