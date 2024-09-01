<?php
 include 'inc/header.php'; 
require_once 'inc/connection.php';
require_once 'App.php';


?>




<div class="container my-5">

    <div class="row">

    <?php
    
        if($request->get("id")){
            $id = $request->get("id");

            $runQuery = $conn->prepare("select * from products where `id` = :id");
            $runQuery->bindParam(":id" , $id , pdo::PARAM_INT);
            $runQuery->execute();
            if($runQuery->rowCount() == 1){

                $product = $runQuery->fetch(pdo::FETCH_ASSOC); ?>

<div class="col-lg-6">
            <img src="images/<?php echo $product['image']?>" class="card-img-top">
            </div>
            <div class="col-lg-6">
            <h5 ><?php echo $product['name']?></h5>
            <p class="text-muted"><?php echo $product['price']?> EGP</p>
            <p><?php echo $product['description']?></p>
            <a href="index.php" class="btn btn-primary">Back</a>
            <?php
                        if($request->check($session->get("user_id"))  && $session->get("status") == "admin"):
                    
                    ?>
            <a href="edit.php?id=<?php echo $product['id']?>" class="btn btn-info">Edit</a>
            <a href="handle/delete.php?id=<?php echo $product['id']?>" class="btn btn-danger">Delete</a>
            <?php
            endif;
            
            ?>
        </div>
        
    </div>



        <?php    }




        }
    
    
    ?>


  
</div>



<?php include 'inc/footer.php'; ?>