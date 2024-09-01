<?php
require_once '../inc/connection.php';

require_once "../App.php";


if($request->check($request->get("id"))){
    $id = $request->get("id");

    $runQuery = $conn->prepare("select * from products where id = :id" );
    $runQuery->bindParam(":id" , $id);
    $runQuery->execute();
    if($runQuery->rowCount() == 1){

      $runQuery =  $conn->prepare("delete from products where id=:id");
      $runQuery->bindParam("id" , $id);

      if($runQuery->execute()){

        $session->set("success" , "product deleted successfully");
        $request->redirect("../index.php");
      }else{

        $session->set("errors" , ["error while delete product"] );
        $request->redirect("../index.php");

      }

    }else{
        $session->set("errors" , ["product not found"]);
        $request->redirect("../index.php");

    }



}else{

    $request->redirect("../index.php");
}