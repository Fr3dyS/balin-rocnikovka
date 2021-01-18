<?php
include('config/lang.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $lang['title']; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link href="css.css" type="text/css" rel="stylesheet">
</head>

<body>
    <?php include_once('pohledy/doplnky/header.php'); ?>
    <h1><?php echo $lang['title']; ?></h1>

    <div class="container-fluid">
        <div class="row flex-box-set">
            <?php
            $stmt = $db->prepare("SELECT * FROM `kits_products` LIMIT 3");
            $stmt->execute();
            $datas = $stmt->fetchAll();
            foreach ($datas as $data) { ?>
                <div class="card text-center box-card-set">
                    <img src="administration/<?php echo $data['kits_product_img']; ?>" class="card-img-top box-image-set img-fluid image" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"> <?php if (strlen($data['kits_product_name']) > 50) {
                                                    echo substr($data['kits_product_name'], 0, 50) . '....';
                                                } else {
                                                ?><a href="produkty2.php?id=<?php echo $data['kits_product_id']; ?>"> <?php echo $data['kits_product_name']; ?> </a>
                            <?php } ?></h5>
                        <?php if ($data['kits_product_status'] > 1) {
                        ?>
                            <h3><span class="badge badge-secondary">K dispozici</span></h3>
                        <?php } else {
                        ?> <h3><span class="badge badge-secondary">Prodáno</span></h3> <?php
                                                                                    } ?>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"> <?php echo $lang['Price']; ?>:</div>
                                <div class="col-6"><?php echo $data['kits_product_price']; ?></div>
                            </div>
                        </li>
                        <form method="post" class="submitpro">
                            <li class="list-group-item">
                                <div class="form-group row mb-0">
                                    <label for="staticEmail" class="col-6 col-form-label"> <?php echo $lang['Quantity']; ?>: </label>
                                    <div class="col-6">
                                        <input type="number" class="form-control pro-qty" min="1" max="100" value="1" required>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <button type="submit" class="btn btn-sm bg-danger text-light pc_data" data-dataid="<?php echo $data['kits_code']; ?>"><?php echo $lang['kosik']; ?></button>
                            </li>
                        </form>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.submitpro').on('submit', function(e) {
                var product_num = $(this).find('.pc_data').data('dataid');
                var product_qty = $(this).find('.pro-qty').val();
                //alert("product Num = "+product_num+" Product Qty "+product_qty);
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


</body>

</html>