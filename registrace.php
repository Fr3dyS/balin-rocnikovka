<?php
include('config/lang.php');

require 'config/configDB.php';

// TEST 
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
}
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
//whether ip is from remote address
else {
    $ip_address = $_SERVER['REMOTE_ADDR'];
}

if (isset($_REQUEST['btn_register'])) //button name "btn_register"
{
    $email        = strip_tags($_REQUEST['email']);
    $fullname = strip_tags($_REQUEST['fullname']);
    $password    = strip_tags($_REQUEST['password']);
    $spassword = strip_tags($_REQUEST['spassword']);
    $telefon = strip_tags($_REQUEST['telefon']);
    $ulice = strip_tags($_REQUEST['ulice']);
    $mesto = strip_tags($_REQUEST['mesto']);
    $psc = strip_tags($_REQUEST['psc']);

    if (empty($fullname)) {
        $errorMsg[] = "Please enter username";    //check username textbox not empty 
    } else if (empty($email)) {
        $errorMsg[] = "Please enter email";    //check email textbox not empty 
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg[] = "Please enter a valid email address";    //check proper email format 
    } else if (empty($password)) {
        $errorMsg[] = "Please enter password";
    } else if ($spassword !== $password) {
        $errorMsg[] = "Hesla nejsou same";
    } else {
        try {
            $select_stmt = $db->prepare("SELECT account_mail FROM accounts 
            WHERE account_mail=:email");

            $select_stmt->execute(array(':email' => $email)); //execute query 
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if ($row["account_mail"] == $email) {
                $errorMsg[] = "Sorry email already exists";    //check condition email already exists 
            } else if (!isset($errorMsg)) //check no "$errorMsg" show then continue
            {
                $new_password = password_hash($password, PASSWORD_DEFAULT);

                $insert_stmt = $db->prepare("INSERT INTO accounts (account_name, account_password, account_mail, account_rank, account_reg_date, account_phone, account_ulice, account_mesto, account_psc, account_ip) VALUES
                (:fullname,:password, :email,1 ,NOW(),:telefon, :ulice, :mesto, :psc, :ip)");

                if ($insert_stmt->execute(array(
                    ':email' =>  $email,
                    ':fullname' => $fullname,
                    ':password' => $new_password,
                    ':telefon'    => $telefon,
                    ':ulice'    => $ulice,
                    ':mesto'    => $mesto,
                    ':psc'    => $psc,
                    ':ip' => $ip_address
                ))) {

                    $registerMsg = $lang['RegistrationSuccessfully'];
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title><?php echo $lang['title']; ?></title>
</head>

<body>
    <?php include('pohledy/doplnky/header.php'); ?>
    <h1>Login</h1>
    <?php
    if (isset($errorMsg)) {
        foreach ($errorMsg as $error) {
    ?>
            <div class="alert alert-danger">
                <strong><?php echo $error; ?></strong>
            </div>
        <?php
        }
    }
    if (isset($registerMsg)) {
        ?>
        <div class="alert alert-success">
            <strong><?php echo $registerMsg; ?></strong>
        </div>
    <?php
    }
    ?>
    <form method="post">
        <div>
            <label><?php echo $lang['prihlasovaciEmail']?></label>
            <input type="text" name="email">
        </div>
        <div>
            <label><?php echo $lang['password']?></label>
            <input type="password" name="password">
        </div>
        <div>
            <label><?php echo $lang['repeatPassword']?></label>
            <input type="password" name="spassword">
        </div>
        <div>
            <label><?php echo $lang['Phone']?></label>
            <input id="phone" name="telefon" class="no-arrow" value="" type="number">
        </div>
        <h1><?php echo $lang['fakturacniUdaje']?></h1>
        <div>
            <label><?php echo $lang['fullName']?></label>
            <input type="text" name="fullname">
        </div>
        <div>
            <label><?php echo $lang['ulice']?></label>
            <input type="text" name="ulice">
        </div>

        <div>
            <label><?php echo $lang['Mesto']?></label>
            <input type="text" name="mesto">
        </div>
        <div>
            <label><?php echo $lang['PSC']?></label>
            <input type="text" name="psc">
        </div>
        <button type="submit" class="btn btn-primary" name="btn_register"><?php echo $lang['login']?></button>
    </form>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>