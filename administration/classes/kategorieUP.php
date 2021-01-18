<?php
require_once('../config/config.php');
if (!isset($_COOKIE['login'])) {
    header('Location: ../index.php');
}


$id = $_GET['id'];
if (isset($_POST['update'])) {
    $title = strip_tags($_REQUEST['title']);
    try {
        $insert_stmt = $db->prepare("UPDATE kits_category SET `category_title` = :title WHERE `category_id` = $id");

        if ($insert_stmt->execute(array(
            ':title' =>  $title
        ))) {

            header('Location: ../kategorie.php');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


#############-----------------------------------------------###############
$stmt = $db->prepare("SELECT * FROM `kits_category` WHERE `category_id` = $id");
$stmt->execute();
$datas = $stmt->fetchAll();
foreach ($datas as $data) {
?>
    <h1>Změna údajů kategorie: <?php echo $data['category_title']; ?></h1>
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
            <label>ID: </label>
            <input type="text" name="id" value="<?php echo $data['category_id']; ?>" disabled>
        </div>
        <div>
            <label>title </label>
            <input type="datetime" name="title" value="<?php echo $data['category_title']; ?>" >
        </div>
        <button type="submit" class="btn btn-primary" name="update">Update kategorie</button>
    <?php } ?>
    </form>