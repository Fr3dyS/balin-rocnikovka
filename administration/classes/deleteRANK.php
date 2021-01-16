<?php
require_once('../config/config.php');


$id = $_GET['id'];

$delete = "DELETE from accounts WHERE account_id  = $id";

$query = mysqli_query($db, $delete);

header('Location: ../accounts.php');
