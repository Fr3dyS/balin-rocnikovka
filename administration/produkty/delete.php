<?php 

$db = new mysqli("localhost", "root", "klobasakecup", "kits");


$id = $_GET['id'];

$delete = "DELETE from kits_products WHERE kits_product_id  = $id";

$query = mysqli_query($db, $delete);

header('Location: ../produkty.php');
