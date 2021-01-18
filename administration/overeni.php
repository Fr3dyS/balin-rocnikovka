<?php
$mysqli = new mysqli("localhost", "root", "klobasakecup", "kits");

$result = mysqli_query($mysqli, "SELECT account_rank FROM accounts where account_rank = '" . $_COOKIE['login'] . "'");

$result_value = mysqli_fetch_array($result);
echo $result_value['account_rank'];

if ($result_value['account_rank'] != 1) {
    header("Location: ../index.php");
}
