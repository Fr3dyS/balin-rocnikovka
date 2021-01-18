<?php include('config/configLang.php');
include('config/config.php');
if (!isset($_COOKIE['login'])) {
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title><?php echo $lang['title']; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <?php include('doplnky/header.php');
    ?>
    <h1>Účty</h1>
    <a href="classes/createAC.php">Vytvořit účet</a>
    <table>
        <tr>
            <th>account id</th>
            <th>account name</th>
            <th>account password</th>
            <th>account mail</th>
            <th>account rank</th>
            <th>account datum registrace</th>
            <th>account phone</th>
            <th>ulice</th>
            <th>mesto</th>
            <th>psc</th>
            <th>ip</th>
            <th>UPDATE</th>
            <th>DELETE</th>
        </tr>
        <tr>
            <th><input type="text" name="" id=""></th>
            <th><input type="text" name="" id=""></th>
            <th><input type="text" name="" id=""></th>
            <th><input type="text" name="" id=""></th>
            <th><input type="text" name="" id=""></th>
            <th><input type="text" name="" id=""></th>
            <th><input type="text" name="" id=""></th>
            <th><input type="text" name="" id=""></th>
            <th><input type="text" name="" id=""></th>
            <th><input type="text" name="" id=""></th>
            <th><input type="text" name="" id=""></th>
        </tr>
        <?php
        $stmt = $db->prepare("SELECT * FROM `accounts`");
        $stmt->execute();
        $datas = $stmt->fetchAll();
        ?>
        <?php foreach ($datas as $data) {    ?>
            <tr>
                <td><?php echo $data['account_id']; ?></td>
                <td><?php echo $data['account_name']; ?></td>
                <td><?php echo $data['account_password']; ?></td>
                <td><?php echo $data['account_mail']; ?></td>
                <td><?php echo $data['account_rank']; ?></td>
                <td><?php echo $data['account_reg_date']; ?></td>
                <td><?php echo $data['account_phone']; ?></td>
                <td><?php echo $data['account_ulice']; ?></td>
                <td><?php echo $data['account_mesto']; ?></td>
                <td><?php echo $data['account_psc']; ?></td>
                <td><?php echo $data['account_ip']; ?></td>
                <td>
                    <a href="classes/deleteAC.php?id=<?php echo $data['account_id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times" aria-hidden="true"></i>Delete</a>
                </td>
                <td>
                    <a href="classes/updateAC.php?id=<?php echo $data['account_id']; ?>"><i class="fa fa-times" aria-hidden="true"></i>Update</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>