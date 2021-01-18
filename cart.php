<?php
include('config/lang.php');

require_once 'config/test.php';
$user_function = new Config;
$counter = 1;

$total = array();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>My Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link href="css.css" type="text/css" rel="stylesheet">
</head>

<body>

    <?php include_once('pohledy/doplnky/header.php'); ?>


    <div class="container-fluid mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <b><?php echo $lang['MyCart']; ?></b>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table class="table v-set">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col"><?php echo $lang['Product']; ?></th>
                                            <th scope="col"><?php echo $lang['Detail']; ?></th>
                                            <th scope="col"><?php echo $lang['Quantity']; ?></th>
                                            <th scope="col"><?php echo $lang['Price']; ?></th>
                                            <th scope="col"><?php echo $lang['Subtotal']; ?></th>
                                            <th scope="col"><?php echo $lang['Action']; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($cart_data) {
                                            foreach ($cart_data as $cart_key => $cart_value) {
                                                $qty = $_SESSION['product_qty_cart'][$cart_key];
                                                $field_val['kits_code'] = $cart_value;
                                                $get_cart = $user_function->select_where_cart("kits_products", $field_val);
                                                $subtotal = $qty * $get_cart['kits_product_price'];
                                                $total[] = $subtotal;
                                        ?>
                                                <tr>
                                                    <th scope="row"><?php echo $counter;
                                                                    $counter++; ?></th>
                                                    <td>
                                                        <img src="administration/<?php echo $get_cart['kits_product_img']; ?>" width="80%" class="">
                                                    </td>
                                                    <td><?php echo $get_cart['kits_product_name']; ?></td>
                                                    <td><?php echo $qty; ?></td>
                                                    <td><?php echo $get_cart['kits_product_price']; ?></td>
                                                    <td><?php echo $subtotal; ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-danger rm-val" onclick="return confirm('Are you sure you want to delete this item?');" data-dataval="<?php echo $cart_key; ?>">
                                                            <span><i class="far fa-trash-alt"></i></span>
                                                            <span><?php echo $lang['Remove']; ?></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } else {
                                            echo "<tr><td colspan='7'><h1 class='text-center' >Cart is Empty</h1></td></tr>";
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7"><b> Total Amount : <?php echo @array_sum($total); ?> </b> </td>
                                            <?php if (!isset($_COOKIE['login'])) { ?>
                                                <td colspan="7"><a href="login.php">Nejdříve se přihlaš</a> </td>
                                            <?php
                                            } else {
                                            ?> <td colspan="7"><a href="">Zakoupit</a> </td><?php
                                                                                        } ?>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', 'button.rm-val', function() {
                var rm_val = $(this).data('dataval');
                if (rm_val == '') {
                    alert('Data Value Not Found');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "action.php",
                        data: {
                            'rm_val': rm_val
                        },
                        success: function(response) {
                            var get_val = JSON.parse(response);
                            if (get_val.status == 102) {
                                console.log(get_val.msg);
                                location.reload();
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