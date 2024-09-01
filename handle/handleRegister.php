<?php

require_once '../inc/connection.php';
require_once '../App.php';


if($request->check($request->post("submit"))){

    $name = $request->filter($request->post("name"));
    $email = $request->filter($request->post("email"));
    $pass = $request->filter($request->post("password"));


    
    $validation->endValidation("name" , $name , ["Required" , "Str"]);
    $validation->endValidation("email" , $email , ["Required" , "EmailCheck"]);
    $validation->endValidation("password" , $pass , ["Required"]);
    $hashedPassword = $passCheck->hash($pass);
   $errors = $validation->getError();
    if(empty($errors)){
        
            $runQuery = $conn->prepare("insert into users(`name` , `email` , `password`) values(:name , :email , :password)");
        
            $runQuery->bindParam(":name" , $name);
            $runQuery->bindParam(":email" , $email);
            $runQuery->bindParam(":password" , $hashedPassword);

            if($runQuery->execute()){
                $session->set("success" , " register successfully");
                $request->redirect("../index.php");


            }else{
                $session->set("errors" , ["error while registeration"]) ;
                $request->redirect("../register.php");
            }


    }   else{

        $session->set("errors" , $errors);
        $request->redirect("../register.php");

    }     



}else{
    $request->redirect("../index.php");

}