<?php

namespace onlineShop\classess;

class File {

    public $image;

    public function get($image){

       return $this->image = $_FILES[$image];
        

    }

    public function imageName(){

        return $this->image['name'];
    }

    public function tmpName(){
        return $this->image['tmp_name'];
    }

    public function imageSize(){
        return $this->image['size'] / (1024*1024);
    }

    public function extension(){
        return strtolower(pathinfo($this->image['name'] , PATHINFO_EXTENSION) );
    }

    public function imageError(){

        return $this->image['error'];

    }

    public function imageNewName(){

        return uniqid() . "." . $this->extension();
    }

    public function imageExist($x){

        if(! empty($_FILES[$x]) && ! empty($_FILES[$x]["name"])){

            return true;
        }else{
            return false;
        }
    }

    public function moveImage($tmpName , $path){

        move_uploaded_file($tmpName , $path);
    }

    public function imageUnlink($path){

        unlink($path);
    }
    




}