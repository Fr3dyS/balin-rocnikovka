<?php

$db = new mysqli("localhost", "root", "klobasakecup", "kits");


$id = $_GET['id'];

$delete = "DELETE from accounts WHERE account_id  = $id";

$query = mysqli_query($db, $delete);

header('Location: ../accounts.php');
