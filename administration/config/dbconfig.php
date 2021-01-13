<?php

define('HOST','localhost');
define('USER','root');
define('PASS','klobasakecup');
define('DB','kits');


$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
