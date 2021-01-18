<?php
require_once('../config/config.php');
if (!isset($_COOKIE['login'])) {
    header('Location: ../index.php');
}


$id = $_GET['id'];

$delete = "DELETE from kits_brands WHERE kits_brand_id  = $id";

$query = mysqli_query($con, $delete);

header('Location: ../znacka.php');
