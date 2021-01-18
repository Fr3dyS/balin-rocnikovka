<?php
include('config/lang.php');
require_once('config/configDB.php');

$_SESSION['id'] = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?php echo $lang['title']; ?></title>
    <link rel="stylesheet" href="css.css">
</head>

<body>
    <?php include('pohledy/doplnky/header.php'); ?>
    <form method="POST" class="submitpro" action="produkty2.php">
        <main class="container">
            <?php
            $stmt = $db->prepare("SELECT kits_product_id, kits_category.category_title, kits_brands.kits_brand_title  ,kits_product_date ,kits_product_name, kits_product_desc, desc_full , status  ,kits_product_price ,kits_product_status, kits_product_img ,kits_code FROM `kits_products` JOIN kits_category ON kits_products.kits_category_id=kits_category.category_id JOIN kits_brands ON kits_products.kits_brand_id = kits_brands.kits_brand_id WHERE `kits_product_id` ='{$_SESSION['id']}'");
            $stmt->execute();
            $datas = $stmt->fetchAll();
            foreach ($datas as $data) { ?>
                <img data-image="black" src="administration/<?php echo $data['kits_product_img'] ?>" class="card-img-top box-image-set img-fluid image" alt="">
                <div class="right-column">

                    <div class="product-description">
                        <span>Kategorie: <?php echo $data['category_title'] ?></span></br>
                        <span>Značka: <?php echo $data['kits_brand_title'] ?></span>
                        <h1><?php echo $data['kits_product_name'] ?></h1>
                        <p><?php echo $data['desc_full'] ?></p>

                    </div>
                    <?php if ($data['kits_product_status'] > 1) {
                    ?>
                        <h3><span class="badge badge-secondary">K dispozici</span></h3>
                    <?php } else {
                    ?> <h3><span class="badge badge-secondary">Prodáno</span></h3> <?php
                                                                                    } ?>
                    <div class="product-configuration">

                        <div class="product-price">
                            <div class="form-group row mb-0">

                                <label for="staticEmail" class="col-6 col-form-label"> <?php echo $lang['Quantity']; ?>: </label>
                                <div class="col-6">
                                    <input type="number" class="form-control pro-qty" min="1" max="100" value="1" required>
                                </div>
                            </div>
                            <span>Cena: <?php echo $data['kits_product_price'] ?> Kč</span></br>
                            <button type="submit" class="btn btn-sm bg-danger text-light pc_data" data-dataid="<?php echo $data['kits_code']; ?>"><?php echo $lang['kosik']; ?></button>
                        </div>
                    </div>
        </main>
    <?php }
    ?>
    </form>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.submitpro').on('submit', function(e) {
                var product_num = $(this).find('.pc_data').data('dataid');
                var product_qty = $(this).find('.pro-qty').val();
                if (product_num == '' || product_qty == '') {
                    alert("Data Key Not Found");
                    console.log("Data Key Not Found");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "action.php",
                        data: {
                            'product_num': product_num,
                            'product_qty': product_qty,
                        },
                        success: function(response) {
                            var get_val = JSON.parse(response);
                            if (get_val.status == 100) {
                                alert(get_val.msg);
                                console.log(get_val.msg);
                                location.reload();
                            } else if (get_val.status == 103) {
                                alert(get_val.msg);
                                console.log(get_val.msg);
                            } else {
                                console.log(get_val.msg);
                            }
                        }
                    });
                }
            });
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>