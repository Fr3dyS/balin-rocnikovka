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
    <script src="pohledy/script/googlePay.js"></script>
</head>

<body>

    <h1><?php echo $lang['doprava']; ?></h1>

    <?php
    $stmt = $db->prepare("SELECT * FROM `kits_doprava` WHERE `typ`= 'doprava'");
    $stmt->execute();
    $datas = $stmt->fetchAll();
    ?>
    <form method="post">
        <?php
        foreach ($datas as $data) {
            selectDoprava($data["id"], $data["nazev"], $data["typ"], $data["cena"]);
        }
        ?>
    </form>

    <h1><?php echo $lang['platba']; ?></h1>
    <?php
    $stmt = $db->prepare("SELECT * FROM `kits_doprava` WHERE `typ`= 'platba'");
    $stmt->execute();
    $datas = $stmt->fetchAll();
    ?>
    <form method="post">
        <?php
        foreach ($datas as $data) {
            selectPlatba($data["id"], $data["nazev"], $data["typ"], $data["cena"]);
        }
        ?>
    </form>
    <button onclick="location.href='produkty.php'">Zpět do obchodu</button>
    <button onclick="location.href='cart2.php'">o krok zpět</button>
    <button>Dokončit platbu</button>
    <div id="container"></div>
    <script async   src="https://pay.google.com/gp/p/js/pay.js"   onload="onGooglePayLoaded()"></script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>