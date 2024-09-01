<?php

require_once '../inc/connection.php';
require_once '../App.php';


if($request->check($request->post("submit"))){
    // catch
    $name = $request->filter($request->post("name"));
    $price = $request->filter($request->post("price"));
    $desc = $request->filter($request->post("desc"));
    $image = $file->get("image");
    $imageName = $file->imageName();
    $imageExt = $file->extension();
    $imageSize = $file->imageSize();
    $imageError = $file->imageError();
    $imageNewName = $file->imageNewName();
    $imageTmpName = $file->tmpName();



    // validation 

    $validation->endValidation('name' , $name , ["Required" , "Str"]);
    $validation->endValidation('price' , $price ,['Required' , "IsNumber"]);
    $validation->endValidation('description' , $desc , ["Required"]);
    $validation->endValidation('image' , $imageError , ["ErrorCheck"]);
    $validation->endValidation('image' , $imageSize , ["SizeCheck"]);
    $validation->endValidation('image' , $imageExt , ["ExtCheck"]);

    $errors = $validation->getError();

    if(empty($errors)){


        $runQuery = $conn->prepare("insert into products(`name` , `price` , `description` , `image`) values(:name , :price , :desc ,:image)");

        $runQuery->bindParam(":name" , $name) ;
        $runQuery->bindParam(":price" , $price) ;
        $runQuery->bindParam(":desc" , $desc) ;
        $runQuery->bindParam(":image" , $imageNewName) ;
        if($runQuery->execute()){
            $file->moveImage($imageTmpName , "../images/$imageNewName");
            $session->set("success" , "product added successfully");
            $request->redirect("../index.php");


        }else{
            $session->set("errors" , ["error while insert product"]);
            $request->redirect("../add.php");

        }





    }else{

        $session->set("errors" , $errors);
        $request->redirect("../add.php");

    }












}else{
    $request->redirect("../index.php");
}