<?php
include('config/lang.php');

require 'config/configDB.php';

if (isset($_SESSION["user_login"]))    //check condition user login not direct back to index.php page
{
    header("location: index.php");
}

if (isset($_REQUEST['btn_login']))    //button name is "btn_login" 
{
    $username    = strip_tags($_REQUEST["txt_username_email"]);    //textbox name "txt_username_email"
    $email        = strip_tags($_REQUEST["txt_username_email"]);    //textbox name "txt_username_email"
    $password    = strip_tags($_REQUEST["txt_password"]);            //textbox name "txt_password"

    if (empty($username)) {
        $errorMsg[] = "please enter username or email";    //check "username/email" textbox not empty 
    } else if (empty($email)) {
        $errorMsg[] = "please enter username or email";    //check "username/email" textbox not empty 
    } else if (empty($password)) {
        $errorMsg[] = "please enter password";    //check "passowrd" textbox not empty 
    } else {
        try {
            $select_stmt = $db->prepare("SELECT * FROM accounts WHERE account_mail=:email"); //sql select query
            $select_stmt->execute(array(':email' => $email));    //execute query with bind parameter
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if ($select_stmt->rowCount() > 0)    //check condition database record greater zero after continue
            {
                if ($email == $row["account_mail"]) //check condition user taypable "username or email" are both match from database "username or email" after continue
                {
                    if (password_verify($password, $row["account_password"])) //check condition user taypable "password" are match from database "password" using password_verify() after continue
                    {
                        $_SESSION["user_login"] = $row["account_id"];    //session name is "user_login"
                        $loginMsg = "Successfully Login...";        //user login success message
                        header("refresh:2; index.php");            //refresh 2 second after redirect to "welcome.php" page
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
    <form method="post" class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $lang['email']; ?></label>
            <div class="col-sm-6">
                <input type="text" name="txt_username_email" class="form-control" placeholder="<?php echo $lang['emailVloz']; ?> " />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $lang['password']; ?></label>
            <div class="col-sm-6">
                <input type="password" name="txt_password" class="form-control" placeholder="<?php echo $lang['passwordVloz']; ?>" />
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9 m-t-15">
                <input type="submit" name="btn_login" class="btn btn-success" value="<?php echo $lang['login']; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9 m-t-15">
                <label><?php echo $lang['expiration']; ?></label>
                <input type="checkbox" name="expiration" class="btn" >
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9 m-t-15">
                <?php echo $lang['nemamUcet']; ?><a href="registrace.php">
                    <p class="text-info"><?php echo $lang['registruj']; ?></p>
                </a>
            </div>
        </div>

    </form>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>