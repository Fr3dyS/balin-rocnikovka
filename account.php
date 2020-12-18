<?php
include('config/lang.php');

require 'config/configDB.php';

if (isset($_REQUEST['save'])) {
    $email        = strip_tags($_REQUEST['account_email']);
    $fullname = strip_tags($_REQUEST['account_name']);
    $telefon = strip_tags($_REQUEST['account_phone']);
    $ulice = strip_tags($_REQUEST['account_ulice']);
    $mesto = strip_tags($_REQUEST['account_mesto']);
    $psc = strip_tags($_REQUEST['account_psc']);
    $id = strip_tags($_COOKIE['login']);

    try {
        $update_stmt = $db->prepare("UPDATE accounts SET account_name=:fullname, account_mail=:email, account_phone=:telefon, account_ulice=:ulice, account_mesto=:mesto, account_psc=:psc WHERE account_id=:id");

        if ($update_stmt->execute(array(
            ':email' =>  $email,
            ':fullname' => $fullname,
            ':telefon'    => $telefon,
            ':ulice'    => $ulice,
            ':mesto'    => $mesto,
            ':psc'    => $psc,
            ':id' => $id
        ))) {

            $updateMsg = "Uloženo";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
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
    <?php include('pohledy/doplnky/header.php'); ?>
    <h1><?php echo $lang['account']; ?></h1>
    <?php
    if (isset($updateMsg)) {
    ?>
        <div class="alert alert-success">
            <strong><?php echo $updateMsg; ?></strong>
        </div>
    <?php
    }
    if (isset($_COOKIE['login'])) { ?>
        <form method="post">
            <div>
                <label><?php echo $lang['account_reg_date'] ?></label>
                <input type="text" name="account_reg_date" value="<?php echo $row['account_reg_date']; ?>" disabled>
            </div>
            <div>
                <label><?php echo $lang['zmenaJmena'] ?></label>
                <input type="text" name="account_name" value="<?php echo $row['account_name']; ?>">
            </div>
            <div>
                <label><?php echo $lang['zmenaEmailu'] ?></label>
                <input type="text" name="account_email" value="<?php echo $row['account_mail']; ?>">
            </div>
            <div>
                <label><?php echo $lang['zmenaTelefonu'] ?></label>
                <input type="text" name="account_phone" value="<?php echo $row['account_phone']; ?>">
            </div>
            <div>
                <label><?php echo $lang['zmenaUlice'] ?></label>
                <input type="text" name="account_ulice" value="<?php echo $row['account_ulice']; ?>">
            </div>
            <div>
                <label><?php echo $lang['zmenaMesto'] ?></label>
                <input type="text" name="account_mesto" value="<?php echo $row['account_mesto']; ?>">
            </div>
            <div>
                <label><?php echo $lang['zmenaPsc'] ?></label>
                <input type="text" name="account_psc" value="<?php echo $row['account_psc']; ?>">
            </div>
            <input type="submit" name="save" value="<?php echo $lang['save'] ?>">
        </form>
    <?php
    }
    ?>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>