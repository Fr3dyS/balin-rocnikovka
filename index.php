<?php
include('config/lang.php');
require_once('pohledy/classes/component.php');

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'klobasakecup');
define('DB', 'kits');



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?php echo $lang['title']; ?></title>
    <style>
        body {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include('pohledy/doplnky/header.php'); ?>
    <h1><?php echo $lang['title']; ?></h1>
    <h3>,,motivačný text k zakoupení zboží"</h3>
    <a href="produkty.php">Produkty</a>
    <div class="container">
        <div class="row text-center py-5">
            <?php
            $result = $con->getData();
            while ($row = mysqli_fetch_assoc($result)) {
                component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
            }
            ?>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>