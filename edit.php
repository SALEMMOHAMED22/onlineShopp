<?php include 'inc/header.php';

require_once 'inc/connection.php';
require_once 'App.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">

<?php

    require_once 'inc/errors.php';
    require_once 'inc/success.php';

?>


        <?php
            if($request->get("id")){
                $id = $request->get("id");
    
                $runQuery = $conn->prepare("select * from products where `id` = :id");
                $runQuery->bindParam(":id" , $id , pdo::PARAM_INT);
                $runQuery->execute();
                if($runQuery->rowCount() == 1){
    
                    $product = $runQuery->fetch(pdo::FETCH_ASSOC); ?>
        
        
        
   


            <form action="handle/editeHandle.php?id=<?php echo $product['id']?>" method="post" enctype="multipart/form-data" >
                <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name = "name" value="<?php echo $product['name']?>">
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" class="form-control" id="price" name="price"  value="<?php echo $product['price']?>">
                </div>

                <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description:</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name = "desc"> <?php echo $product['description']?></textarea>
                </div>

                <div class="mb-3">
                <label for="formFile" class="form-label">Image:</label>
                <input class="form-control" type="file" id="formFile" name="img" >
                </div>

                <div class="col-lg-3">
                        <img src="images/<?php echo $product['image']?>" class="card-img-top">
                        </div>
                        
                <center><button on type="submit" class="btn btn-primary" name="submit">Update</button></center>
            </form>
                   <?php
                   
                }}
                   ?>


        </div>
    </div>
</div>



<?php include 'inc/footer.php'; ?>