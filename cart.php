<?php

require_once('config/configDB.php');
require_once('config/lang.php');
require_once('pohledy/classes/component.php');

$mysqli = mysqli_connect("localhost", "root", "klobasakecup", "kits");

if (isset($_POST['remove'])) {
    if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value["product_id"] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been Removed...!')</script>";
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $lang['title']; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="bg-light">

    <?php
    require_once('pohledy/doplnky/header.php');
    ?>

    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                    <h6><?php echo $lang['MyCart']; ?></h6>

                    <hr>
                    <?php
                    $total = 0;
                    $totalPrice = 4;
                    if (isset($_SESSION['cart'])) {
                        $count  = count($_SESSION['cart']);
                        $_SESSION['doprava'] = count($_SESSION['cart']);
                        if ($count > 0) {
                            $product_id = array_column($_SESSION['cart'], 'product_id');

                            $sql = "SELECT * FROM `kits_products`";
                            $result = mysqli_query($mysqli, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                foreach ($product_id as $id) {
                                    if ($row['kits_product_id'] == $id) {
                    ?>

                                        <form action="cart.php?action=remove&id=<?php echo $row['kits_product_id']; ?>" method="post" class="cart-items">
                                            <div class="border rounded">
                                                <div class="row bg-white">
                                                    <div class="col-md-3 pl-0">
                                                        <?php $img = $row['kits_product_img'];
                                                        echo "<img src='administration/$img' height='100%' width='100%'>"; ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="pt-2"><?php echo $row['kits_product_name']; ?></h5>
                                                        <button type="submit" class="btn btn-danger mx-2" name="remove">Remove</button>
                                                    </div>
                                                    <div class="col-md-3 py-5">
                                                        <div>
                                                            <input type="number" id="hodnota" min="0" value="1" class="form-control w-25 d-inline">
                                                            <input type="number" name="" value="<?php echo $row['kits_product_price'] ?>" id="cena" disabled>
                                                            Celková cena<div id="test" value="<?php echo $row['kits_product_price']; ?>" ></div>
                                                        </div>
                                                        <script>
                                                            $(document).ready(function() {

                                                                var content = $('#hodnota').val();
                                                                var cena = $('#cena').val()

                                                                $('#hodnota').keyup(function() {

                                                                    if ($('#hodnota').val() != content) {
                                                                        content = $('#hodnota').val().replace(/\\n/g, "<br />");

                                                                        $('#test').text(content * cena);
                                                                        $('#hotovo').text(content * cena);
                                                                    }
                                                                });
                                                            });
                                                        </script>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                    <?php
                                        $total = $total + (int)$row['kits_product_price'];
                                    }
                                }
                            }
                        } else {
                            echo "<h5>" . $lang['emptyKosik'] . "</h5>";
                        }
                    } else {
                        echo "<h5> " . $lang['emptyKosik'] . "</h5>";
                    }

                    ?>

                </div>
            </div>
            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
                <div class="pt-4">
                    <h6><?php echo $lang['PriceDetails']; ?></h6>

                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php
                            if (isset($_SESSION['cart'])) {
                                if ($count > 0) {
                                    $price = $lang['Price'];
                                    $items = $lang['items'];
                                } else {
                                }
                            } else {
                                echo "<h6>" . $lang['emptyKosik'] . "</h6>";
                            }
                            ?>
                            <h6><?php echo $lang['delivery']; ?></h6>
                            <hr>
                            <h6><?php echo $lang['AmountPayable']; ?></h6>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-success"><?php echo $lang['FREE']; ?></h6>
                            <hr>
                            <div>
                                <h6 id="hotovo"> Kč</h6>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($_COOKIE['login'])) {
                        if (isset($_SESSION['cart'])) {
                            if ($count > 0) {
                    ?> <button onclick="location.href='cart2.php'"><?php echo $lang['koupit']; ?></button><?php
                                                                                                        } else {
                                                                                                            ?> <button onclick="location.href='produkty.php'">Není vybrano zbozi</button><?php
                                                                                                                                                                                        }
                                                                                                                                                                                    } else {
                                                                                                                                                                                            ?> <a href="login.php" class="nav-item nav-link "><?php echo $lang['login']; ?></a> <?php
                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                        } ?>
                </div>
            </div>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>