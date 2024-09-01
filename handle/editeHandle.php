<?php
require_once '../inc/connection.php';
require_once '../App.php';
?>

<?php


if ($request->check($request->post("submit")) && $request->check($request->get('id'))) {


    $id = $request->get("id");
    $name = $request->filter($request->post("name"));
    $price = $request->filter($request->post("price"));
    $desc = $request->filter($request->post("desc"));



    //validation
    $validation->endValidation('name', $name, ["Required", "Str"]);
    $validation->endValidation('price', $price, ['Required', "IsNumber"]);
    $validation->endValidation('description', $desc, ["Required"]);
    $errors = $validation->getError();





    $runQuery = $conn->prepare("select * from products where `id`=:id");
    $runQuery->bindParam(":id", $id);
    $runQuery->execute();
    if ($runQuery->rowCount() == 1) {

        $product = $runQuery->fetch(pdo::FETCH_ASSOC);

        $oldImageName = $product['image'];





        if ($file->imageExist("img")) {

            $image = $file->get("img");
            $imageName = $file->imageName();
            $imageExt = $file->extension();
            $imageSize = $file->imageSize();
            $imageError = $file->imageError();
            $imageNewName = $file->imageNewName();
            $imageTmpName = $file->tmpName();


            $validation->endValidation('image', $imageError, ["ErrorCheck"]);
            $validation->endValidation('image', $imageSize, ["SizeCheck"]);
            $validation->endValidation('image', $imageExt, ["ExtCheck"]);


            $errors = $validation->getError();
        } else {
            $imageNewName = $oldImageName;
        }






        if (empty($errors)) {
            $runQuery = $conn->prepare(" update products set `name` = :name , `price`=:price , `description` = :desc ,`image`=:image where `id` = :id");
            $runQuery->bindParam(":id", $id);
            $runQuery->bindParam(":name", $name);
            $runQuery->bindParam(":price", $price);
            $runQuery->bindParam(":desc", $desc);
            $runQuery->bindParam(":image", $imageNewName);

            if ($runQuery->execute()) {
                if ($file->imageExist("img")) {
                    $file->imageUnlink("../images/$oldImageName");
                    $file->moveImage($imageTmpName, "../images/$imageNewName");
                }

                $session->set("success", "product updated successfully");
                $request->redirect("../index.php");
            } else {
                $session->set("errors", ["error while update"]);
                $request->redirect("../edit.php");
            }
        } else {

            $session->set("errors", $errors);
            $request->redirect("../edit.php");
        }
    } else {

        $session->set("errors", ["product not found"]);
        $request->redirect("../index.php");
    }
} else {

    $request->redirect("../index.php");
}
