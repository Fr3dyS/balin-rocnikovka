<?php


require_once('config/configDB.php');
require_once('config/lang.php');
require_once('pohledy/classes/component.php');

$mysqli = mysqli_connect("localhost", "root", "klobasakecup", "kits");

if (isset($_POST['add'])) {
    // print_r($_POST['product_id']);
    if (isset($_SESSION['cart'])) {

        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if (in_array($_POST['product_id'], $item_array_id)) {
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'produkty.php'</script>";
        } else {

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }
    } else {

        $item_array = array(
            'product_id' => $_POST['product_id']
        );

        $_SESSION['cart'][0] = $item_array;
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
    <style>
        img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>


    <?php require_once('pohledy/doplnky/header.php'); ?>
    <div class="container">
        <div class="row text-center py-5">
            <?php
            $sql = "SELECT * FROM `kits_products`";
            $result = mysqli_query($mysqli, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $productname = $row['kits_product_name'];
                $productprice = $row['kits_product_price'];
                $img = $row['kits_product_img'];
                $productid = $row['kits_product_id'];
            ?><div class="col-md-3 col-sm-6 my-3 my-md-0">
                    <form action="produkty.php" method="post">
                        <div class="card shadow">
                            <div>
                                <img src=administration\tmp\images\<?php echo $img; ?> alt="Image1" class="img-fluid card-img-top">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $productname; ?></h5>
                                <h6>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </h6>
                                <p class="card-text">
                                    Some quick example text to build on the card.
                                </p>
                                <h5>
                                    <small><s class="text-secondary">$519</s></small>
                                    <span>$<?php echo $productprice; ?></span>
                                </h5>

                                <button type="submit" class="btn btn-warning my-3" name="add">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                                <input type='hidden' name='product_id' value='<?php echo $productid; ?>'>
                            </div>
                        </div>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>
    </div>





    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>