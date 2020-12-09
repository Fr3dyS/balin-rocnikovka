<?php
include('config/lang.php');
require 'config/configDB.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?php echo $lang['title']; ?></title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/product/">
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="node_modules/mdb-ecommerce/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/mdb-ecommerce/css/mdb.min.css">
    <link rel="stylesheet" href="node_modules/mdb-ecommerce/css/mdb.ecommerce.min.css">
</head>

<body>
    <?php include('pohledy/doplnky/header.php'); ?>
    <h1><?php echo $lang['produkty']; ?></h1>
    <div class="row">
        <?php

        $stmt = $db->prepare('SELECT * FROM kits_products');
        $stmt->execute();
        $datas = $stmt->fetchAll();

        foreach($datas as $data){
            $id_product = $data['kits_product_id'];
            $name_product = $data['kits_product_name'];
            $price_product = $data['kits_product_price'];
        ?>

                <div class="col s12 m4">
                    <div class="card hoverable animated slideInUp wow">
                        <div class="card-image">
                            <a href="productDetails.php?id=<?= $id_product; ?>">
                            <span class="card-title grey-text"><?= $name_product; ?></span>
                            <a href="productDetails.php?id=<?= $id_product; ?>" class="btn-floating halfway-fab waves-effect waves-light right"><i class="material-icons">add</i></a>
                        </div>
                        <div class="card-action">
                            <div class="container-fluid">
                                <h5 class="white-text"><?= $price_product; ?> $</h5>
                            </div>
                        </div>
                    </div>
                </div>
        <?php } ?>
    
        <script type="text/javascript" src="node_modules/mdb-ecommerce/js/jquery.min.js"></script>
        <script type="text/javascript" src="node_modules/mdb-ecommerce/js/popper.min.js"></script>
        <script type="text/javascript" src="node_modules/mdb-ecommerce/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="node_modules/mdb-ecommerce/js/mdb.min.js"></script>
        <script type="text/javascript" src="node_modules/mdb-ecommerce/js/mdb.ecommerce.min.js"></script>
        <script type="text/javascript"></script>
        <script src="./Product example for Bootstrap_files/bootstrap.min.js.stažený soubor"></script>
        <script src="./Product example for Bootstrap_files/holder.min.js.stažený soubor"></script>
        <script>
            Holder.addTheme('thumb', {
                bg: '#55595c',
                fg: '#eceeef',
                text: 'Thumbnail'
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>