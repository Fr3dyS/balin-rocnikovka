<?php
if (isset($_COOKIE['login'])) {
    header('Location: index.php');
    exit;
}
include('config/lang.php');

require 'config/configDB.php';
if (isset($_REQUEST['btn_login'])) {
    $email        = strip_tags($_REQUEST["email"]);
    $password    = strip_tags($_REQUEST["password"]);


    try {
        $select_stmt = $db->prepare("SELECT * FROM accounts WHERE account_mail=:email");
        $select_stmt->execute(array(':email' => $email));
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        if ($select_stmt->rowCount() > 0) {
            if ($email == $row["account_mail"]) {
                if (password_verify($password, $row["account_password"])) {
                        if (isset($_POST['rememberme']) && ($_POST["rememberme"] == '1' || $_POST["rememberme"] == 'on')) {
                            $hour = time() + 3600 * 24 * 30;
                            setcookie("login", $row["account_id"], $hour);
                        } else {
                            setcookie("login", $row["account_id"], time() + 7200);
                        }
                  
                    $loginMsg = $lang['LoginSuccessfully'];
                    header("refresh:2; index.php");
                } else {
                    $errorMsg[] = "wrong password";
                }
            } else {
                $errorMsg[] = "wrong username or email";
            }
        } else {
            $errorMsg[] = "wrong username or email";
        }
    } catch (PDOException $e) {
        $e->getMessage();
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
    <h1><?php echo $lang['login']; ?></h1>
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
    if (isset($loginMsg)) {
        ?>
        <div class="alert alert-success">
            <strong><?php echo $loginMsg; ?></strong>
        </div>
    <?php
    }
    ?>
    <form method="post" id="form" class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $lang['email']; ?></label>
            <div class="col-sm-6">
                <input type="text"  name="email" id="email" class="form-control" placeholder="<?php echo $lang['emailVloz']; ?> " />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $lang['password']; ?></label>
            <div class="col-sm-6">
                <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo $lang['passwordVloz']; ?>" />
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9 m-t-15">
                <input type="submit" name="btn_login" class="btn btn-success" value="<?php echo $lang['login']; ?>">
            </div>
        </div>
        <div class="form-group">
            <input type="checkbox" name="rememberme" value="1" />&nbsp;Remember Me
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9 m-t-15">
                <?php echo $lang['nemamUcet']; ?><a href="registrace.php">
                    <p class="text-info"><?php echo $lang['registruj']; ?></p>
                </a>
            </div>
        </div>

    </form>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $("#form").validate({
            rules: {

                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                }

            },
            messages: {
                email: {
                    required: "vlož email",
                },
                password: {
                    required: "vlož heslo",
                },
            }
        });
    </script>

</body>

</html>