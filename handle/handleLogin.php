<?php

require_once '../inc/connection.php';
require_once '../App.php';

if($request->check($request->post("submit"))){

    $email = $request->filter($request->post("email"));
    $password = $request->filter($request->post("password"));

    $validation->endValidation("email" , $email , ["Required" , "EmailCheck"]);
    $validation->endValidation("password" , $password , ["Required"]);
   $errors = $validation->getError();
   if(empty($errors)){

    $runQuery = $conn->prepare("select * from users where `email` = :email");
    $runQuery->bindParam(":email" , $email);
    $runQuery->execute();
    if($runQuery->rowCount() == 1){

        $user = $runQuery->fetch(pdo::FETCH_ASSOC);
        $hashPass = $user["password"];
        $id = $user['id'];
        $name = $user['name'];
        $status = $user['status'];
        

        if($passCheck->verifyPassword($password , $hashPass)){

            $session->set("user_id" , $id);
            $session->set("status" , $status);

            $session->set("success" , "Welcome $name");
            $request->redirect("../index.php");

        }else{
            $session->set("errors" , ["credential not correct"]);
            $request->redirect("../Login.php");

        }



    }
    


   }else{
    $session->set("errors" , $errors);
    $request->redirect("../Login.php");
   }


    



}else{
    $request->redirect("../index.php");
}