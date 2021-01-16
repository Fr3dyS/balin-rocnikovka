<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'klobasakecup');
define('DB', 'kits');


$con = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect');

$db_host = "localhost";
$db_user = "root";
$db_password = "klobasakecup";
$db_name = "kits";

try {
	$db = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOEXCEPTION $e) {
	$e->getMessage();
}
