<?php
include('config/lang.php');

require 'config/configDB.php';

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
    }else if($spassword !== $password){
        $errorMsg[] = "Hesla nejsou same";
    }
     else {
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

                    $registerMsg = "Register Successfully..... Please Click On Login Account Link"; //execute query success message
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
            <label>Přihlašovací email</label>
            <input type="text" name="email">
        </div>
        <div>
            <label>Heslo</label>
            <input type="password" name="password">
        </div>
        <div>
            <label>potvrzení hesla</label>
            <input type="password" name="spassword">
        </div>
        <div>
            <label>telefon</label>
            <input id="phone" name="telefon" class="no-arrow" value="" type="number">
        </div>
        <h1>Fakturační údaje</h1>
        <div>
            <label>Jméno a příjmení (název firmy)</label>
            <input type="text" name="fullname">
        </div>
        <div>
            <label>Ulice</label>
            <input type="text" name="ulice">
        </div>

        <div>
            <label>Město</label>
            <input type="text" name="mesto">
        </div>
        <div>
            <label>PSČ</label>
            <input type="text" name="psc">
        </div>
        <button type="submit" class="btn btn-primary" name="btn_register">Sign in</button>
    </form>
</body>

</html>