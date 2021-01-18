<?php
require_once('../config/config.php');
if (!isset($_COOKIE['login'])) {
    header('Location: ../index.php');
}


$id = $_GET['id'];

$delete = "DELETE from accounts WHERE account_id  = $id";

$query = mysqli_query($con, $delete);

header('Location: ../accounts.php');
