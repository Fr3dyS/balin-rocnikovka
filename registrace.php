<?php
if (isset($_COOKIE['login'])) {
    header('Location: index.php');
    exit;
}
include('config/lang.php');

require 'config/configDB.php';
if (isset($_REQUEST['btn_register'])) {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }


    $email        = strip_tags($_REQUEST['email']);
    $fullname = strip_tags($_REQUEST['fullname']);
    $password    = strip_tags($_REQUEST['password']);
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
            (:fullname,:password, :email,1 ,NOW(),:telefon, :republika, :ulice, :mesto, :psc, :ip)");

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

                $registerMsg = $lang['RegistrationSuccessfully'];
                header("refresh:2; login.php");
            }
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
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
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
    <form method="post" id="form">
        <div>
            <label><?php echo $lang['prihlasovaciEmail'] ?></label>
            <input type="text" name="email" id="email">
        </div>
        <div>
            <label><?php echo $lang['password'] ?></label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label><?php echo $lang['repeatPassword'] ?></label>
            <input type="password" name="spassword" id="spassword">
        </div>
        <div>
            <label><?php echo $lang['Phone'] ?></label>
            <input id="phone" name="telefon" class="no-arrow" value="" type="number" id="telefon">
        </div>
        <h1><?php echo $lang['fakturacniUdaje'] ?></h1>
        <div>
            <label><?php echo $lang['fullName'] ?></label>
            <input type="text" name="fullname" id="fullname">
        </div>
        <div>
            <label><?php echo $lang['republika'] ?></label>
            <input type="text" name="republika" id="republika">
        </div>
        <div>
            <label><?php echo $lang['ulice'] ?></label>
            <input type="text" name="ulice" id="ulice">
        </div>
        <div>
            <label><?php echo $lang['Mesto'] ?></label>
            <input type="text" name="mesto" id="mesto">
        </div>
        <div>
            <label><?php echo $lang['PSC'] ?></label>
            <input type="text" name="psc" maxlength="5" id="psc">
        </div>
        <button type="submit" class="btn btn-primary" name="btn_register"><?php echo $lang['login'] ?></button>
        <a href="login.php"><?php echo $lang['ucetMam'] ?></a>
    </form>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $("#form").validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5
                },
                spassword: {
                    required: true,
                    equalTo: "#password",
                    minlength: 5
                },
                telefon: {
                    required: true
                },
                fullname: {
                    required: true
                },
                republika: {
                    required: true
                },
                ulice: {
                    required: true
                },
                mesto: {
                    required: true
                },
                psc: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "vlož jméno"
                },
                email: {
                    required: "vlož email",
                    email: "Email je špatně"
                },
                password: {
                    required: "vlož heslo",
                    minlength: "heslo musí mít více, jak 5 znaku"
                },
                spassword: {
                    required: "vlož potvrzení hesla",
                    equalTo: "hesla se nerovnají!",
                    minlength: "heslo musí mít více, jak 5 znaku"
                },
                telefon: {
                    required: "vlož telefon"
                },
                fullname: {
                    required: "vlož celé jméno nebo jméno firmy"
                },
                republika: {
                    required: "vlož název republiky"
                },
                ulice: {
                    required: "vlož ulici"
                },
                mesto: {
                    required: "vlož město"
                },
                psc: {
                    required: "vlož psc"
                }
            }
        });
    </script>

</body>

</html>