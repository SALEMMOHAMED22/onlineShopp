<?php 

include 'inc/header.php';
require_once 'inc/connection.php';
require_once 'App.php';

?>


 

<div class="container my-5">


<?php

require_once 'inc/errors.php';
require_once 'inc/success.php';
?>

    <div class="row">
    <?php
        
        $runQuery = $conn->query("select * from products ");
         if($runQuery->rowCount() > 0){
 
             while($product = $runQuery->fetch(pdo::FETCH_ASSOC)){?>

        
       


        <div class="col-lg-4 mb-3">



            <div class="card">
                <img src="images/<?php echo $product['image']?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product['name']?></h5>
                    <p class="text-muted"><?php echo $product['price']?>  EGP</p>
                    <p class="card-text"><?php echo $product['description']?></p>
                    <a href="show.php?id=<?php echo $product['id']?>" class="btn btn-primary">Show</a>
                    <?php
                        if($request->check($session->get("user_id")) && $session->get("status") == "admin") :
                    
                    ?>
                    <a href="edit.php?id=<?php echo $product['id']?>" class="btn btn-info">Edit</a>
                    <a href="handle/delete.php?id=<?php echo $product['id']?>" class="btn btn-danger">Delete</a>

                    <?php

                endif;
                    
                    ?>

                </div>
            </div>

        </div>

        <?php  }

}else{

    $session->set("errors" , ["There are no products."]);
}

?>

        
    </div>
    



</div>



<?php include 'inc/footer.php'; ?>