<?php require_once('config/lang.php');
    require_once('config/configDB.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 
</head>

<body>
    <?php
    require_once("pohledy/doplnky/header.php");

    $id = $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM `kits_products` WHERE `kits_product_id` = $id");
    $stmt->execute();
    $datas = $stmt->fetchAll();
    foreach ($datas as $data) {
        $recid = $data["kits_product_id"];
    ?>
    <div class="container">

        <div class="shoppingproducts">

            <div class="row">
                <div class="col-md-12">
                    <p>
                        <span class="basket-setting"><?php echo ($numberincart); ?><a href="viewcart.php">&nbsp;Basket</a>&nbsp;<i class="fa fa-shopping-basket fa-1x" aria-hidden="true"></i></span>
                        <br />
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">&nbsp;</div>
                <div class="col-md-6"><img src="assets/shopping_cart.png" alt="Shopping cart image" class="img-fluid" /></div>
                <div class="col-md-4">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-2">&nbsp;</div>
                <div class="col-md-10">
                    <hr>
                </div>
            </div>

            <div class="row">

                
            </div>
        </div> <!-- End shoppingproducts -->
    </div> <!-- End container -->
</body>
</html>