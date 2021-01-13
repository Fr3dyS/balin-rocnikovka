<?php
include('config/lang.php');
require_once('config/configDB.php');
$_SESSION['id'] = $_GET['id'];

if (isset($_POST['add'])) {
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?php echo $lang['title']; ?></title>
</head>

<body>
    <?php include('pohledy/doplnky/header.php'); ?>
    <form method="POST" action="produkty2.php">
    
        <?php
        $stmt = $db->prepare("SELECT * FROM `kits_products` WHERE `kits_product_id` = '{$_SESSION['id']}'");
        $stmt->execute();
        $datas = $stmt->fetchAll();
        foreach ($datas as $data) {
        ?> <h1>Jméno produktu: <?php echo $data['kits_product_name']; ?></h1>
            <?php if ($data['kits_product_status'] > 1) {
            ?><h5>k dispozici</h5><?php
                                } else { ?>
                <h5>Vyprodano</h5>
            <?php } ?>
            <h2>podnadpis: <?php echo $data['kits_product_desc']; ?></h2>
            <h2>cena: <?php echo $data['kits_product_price']; ?> Kč</h2>
            <?php $img = $data['kits_product_img'];
            echo "<img src='administration/$img' height='50%' width='50%'>"; ?>

            <button type="submit" class="btn btn-warning my-3" name="add">Add to Cart<i class="fas fa-shopping-cart"></i></button>
            <input type='hidden' name='product_id' value='<?php echo $data['kits_product_id']; ?>'>
        <?php }
        ?>
    </form>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>