<?php
require_once('pohledy/classes/component.php');
require_once('config/configDB.php');
include('config/lang.php');
if (!$_SESSION['doprava'] > 0) {
    header('Location: produkty');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?php echo $lang['title']; ?></title>
</head>

<body>
    <?php
    $pomoc = $_COOKIE['login']; 
    $stmt = $db->prepare("SELECT * FROM `accounts` WHERE `account_id`= $pomoc");
    $stmt->execute();
    $datas = $stmt->fetchAll();
    foreach ($datas as $data) {
        cart3($data['account_name'], $data['account_mail']);
        changeCart3($data['account_name'], $data['account_mail'], $data['account_phone'], $data['account_republika'], $data['account_ulice'], $data['account_mesto'], $data['account_psc']);
    }

    ?>
    <button onclick="location.href='produkty.php'">Zpět do obchodu</button>
    <button onclick="location.href='cart3.php'">Pokračovat</button>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>