<?php
require_once('../config/config.php');
if (!isset($_COOKIE['login'])) {
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    if (isset($_REQUEST['btn_register'])) {
        $email        = strip_tags($_REQUEST['email']);
        $fullname = strip_tags($_REQUEST['fullname']);
        $password    = strip_tags($_REQUEST['password']);
        $spassword = strip_tags($_REQUEST['spassword']);
        $telefon = strip_tags($_REQUEST['telefon']);
        $republika = strip_tags($_REQUEST['republika']);
        $ulice = strip_tags($_REQUEST['ulice']);
        $mesto = strip_tags($_REQUEST['mesto']);
        $psc = strip_tags($_REQUEST['psc']);

        try {
            $select_stmt = $db->prepare("SELECT account_mail FROM accounts 
            WHERE account_mail=:email");

            $select_stmt->execute(array(':email' => $email));
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if ($row["account_mail"] == $email) {
                $errorMsg[] = "Sorry email already exists";
            } else if (!isset($errorMsg)) {
                $new_password = password_hash($password, PASSWORD_DEFAULT);

                $insert_stmt = $db->prepare("INSERT INTO accounts (account_name, account_password, account_mail, account_rank, account_reg_date, account_phone, account_republika, account_ulice, account_mesto, account_psc, account_ip) VALUES
                (:fullname,:password, :email,3 ,NOW(),:telefon, :republika, :ulice, :mesto, :psc, :ip)");

                if ($insert_stmt->execute(array(
                    ':email' =>  $email,
                    ':fullname' => $fullname,
                    ':password' => $new_password,
                    ':telefon' => $telefon,
                    ':republika' => $republika,
                    ':ulice'    => $ulice,
                    ':mesto'    => $mesto,
                    ':psc'    => $psc,
                    ':ip' => $ip_address
                ))) {

                    header('Location: ../accounts.php');
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    ?>
    <h1>create uzivatel</h1>
    <?php
    if (isset($errorMsg)) {
        foreach ($errorMsg as $error) {
    ?>
            <div class="alert alert-danger">
                <strong><?php echo $error; ?></strong>
            </div>
    <?php
        }
    } ?>
    <form method="post">
        <div>
            <label>email: </label>
            <input type="text" name="email">
        </div>
        <div>
            <label>password: </label>
            <input type="password" name="password">
        </div>
        <div>
            <label>znovu heslo: </label>
            <input type="password" name="spassword">
        </div>
        <div>
            <label>tel. číslo</label>
            <input id="phone" name="telefon" class="no-arrow" value="" type="number">
        </div>
        <h1>fakturacni Udaje</h1>
        <div>
            <label>Celé jméno / název firmy </label>
            <input type="text" name="fullname">
        </div>
        <div>
            <label>republika</label>
            <input type="text" name="republika">
        </div>
        <div>
            <label>ulice</label>
            <input type="text" name="ulice">
        </div>
        <div>
            <label>Mesto</label>
            <input type="text" name="mesto">
        </div>
        <div>
            <label>PSC</label>
            <input type="text" name="psc">
        </div>
        <button type="submit" class="btn btn-primary" name="btn_register">Registrovat nového uživatele</button>
    </form>
</body>

</html>