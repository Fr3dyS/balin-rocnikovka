<?php
require_once('../config/config.php');


$id = $_GET['id'];
if (isset($_POST['update'])) {
    $title = strip_tags($_REQUEST['title']);
    try {
        $insert_stmt = $db->prepare("UPDATE kits_brands SET `kits_brand_title` = :title WHERE `kits_brand_id` = $id");

        if ($insert_stmt->execute(array(
            ':title' =>  $title
        ))) {

            header('Location: ../znacka.php');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


#############-----------------------------------------------###############
$stmt = $db->prepare("SELECT * FROM `kits_brands` WHERE `kits_brand_id` = $id");
$stmt->execute();
$datas = $stmt->fetchAll();
foreach ($datas as $data) {
?>
    <h1>Změna údajů značky : <?php echo $data['kits_brand_title']; ?></h1>
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
            <input type="text" name="id" value="<?php echo $data['kits_brand_id']; ?>" disabled>
        </div>
        <div>
            <label>title </label>
            <input type="datetime" name="title" value="<?php echo $data['kits_brand_title']; ?>" >
        </div>
        <button type="submit" class="btn btn-primary" name="update">Update značky</button>
    <?php } ?>
    </form>