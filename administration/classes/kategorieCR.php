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
    <title>Create kategorie</title>
</head>

<body>
    <?php
    if (isset($_REQUEST['btn_register'])) {
        $title        = strip_tags($_REQUEST['title']);
        try {
            if (!isset($errorMsg)) {
                $insert_stmt = $db->prepare("INSERT INTO kits_category (category_title) VALUES
                (:title)");

                if ($insert_stmt->execute(array(
                    ':title' =>  $title,
                ))) {

                    header('Location: ../kategorie.php');
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    ?>
    <h1>Vytvořit kategorie</h1>
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
            <label>id: </label>
            <input type="text" name="number" disabled placeholder="AUTO">
        </div>
        <div>
            <label>title: </label>
            <input type="text" name="title">
        </div>
        <button type="submit" class="btn btn-primary" name="btn_register">Registrovace nové kategorie</button>
    </form>
</body>

</html>