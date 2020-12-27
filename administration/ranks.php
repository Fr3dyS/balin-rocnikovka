<?php include('config/configLang.php');
include('config/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title><?php echo $lang['title']; ?></title>
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
    <h1>Ranks</h1>
    <table>
        <tr>
            <th>rank id</th>
            <th>rank name</th>
            <th>rank priority</th>
            <th>rank protected</th>
            <th>actions</th>
        </tr>
        <tr>
            <th><input type="text" name="" id=""></th>
            <th><input type="text" name="" id=""></th>
            <th><input type="text" name="" id=""></th>
            <th><input type="text" name="" id=""></th>
        </tr>
        <?php
        $stmt = $db->prepare("SELECT rank_id, rank_name_terms.rank_name_en, rank_name_terms.rank_name_cs, ranks.rank_priority, ranks.rank_protected FROM `ranks` INNER JOIN `rank_name_terms` ON ranks.rank_id = rank_name_terms.rank_name_term_id");
        $stmt->execute();
        $datas = $stmt->fetchAll();
        ?>
        <?php foreach ($datas as $data) {    ?>
            <tr>
                <td><?php echo $data['rank_id']; ?></td>
                <?php if($_GET['lang'] == 'en'){
                    ?> <td><?php echo $data['rank_name_en']; ?></td> <?php 
                }else{
                    ?> <td><?php echo $data['rank_name_cs']; ?></td> <?php 
                } ?>
                <td><?php echo $data['rank_priority']; ?></td>
                <td><?php echo $data['rank_protected']; ?></td>
            </tr>
        <?php } ?>


    </table>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>