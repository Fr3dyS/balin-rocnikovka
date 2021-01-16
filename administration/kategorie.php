<?php
include('CRUD.php');
include('config/config.php');
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
    <script src="https://use.fontawesome.com/14b2fb87e0.js"></script>
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
    <h1>Kategorie</h1>

    <a href="classes/kategorieCR.php">Vytvořit produkt</a>

    <table>
        <tr>
            <th>category id</th>
            <th>category title</th>
            <th>Odebrat</th>
            <th>Upravit</th>
        </tr>

        <?php
        $stmt = $db->prepare("SELECT * FROM `kits_category`");
        $stmt->execute();
        $datas = $stmt->fetchAll();
        ?>
        <?php foreach ($datas as $data) {    ?>
            <tr>
                <td><?php echo $data['category_id']; ?></td>
                <td><?php echo $data['category_title']; ?></td>
                <td>
                    <a href="classes/kategorieDE.php?id=<?php echo $data['category_id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times" aria-hidden="true"></i>Delete</a>
                </td>
                <td>
                    <a href="classes/kategorieUP.php?id=<?php echo $data['category_id']; ?>"><i class="fa fa-times" aria-hidden="true"></i>Update</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>