<?php
require_once('../config/config.php');


$id = $_GET['id'];
if (isset($_POST['update'])) {
    $rankcz = strip_tags($_REQUEST['rankcz']);
    $ranken = strip_tags($_REQUEST['ranken']);

    try {
        if (!isset($errorMsg)) {

            $insert_stmt = $db->prepare("UPDATE rank_name_terms SET `rank_name_en` = :ranken, `rank_name_cs` = :rankcz WHERE `rank_name_term_id` = $id");

            if ($insert_stmt->execute(array(
                ':rankcz' =>  $rankcz,
                ':ranken' => $ranken,
            ))) {

                header('Location: ../ranks.php');
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

###########################################################################
##################--------------############------------###################
####################################----###################################
###########################################################################
#############-----------------------------------------------###############
$stmt = $db->prepare("SELECT ranks.rank_id, rank_name_terms.rank_name_en, rank_name_terms.rank_name_cs, `rank_protected` FROM `ranks` JOIN rank_name_terms ON ranks.rank_id=rank_name_terms.rank_name_term_id WHERE rank_id = $id");
$stmt->execute();
$datas = $stmt->fetchAll();
foreach ($datas as $data) {
?>
    <h1>Změna údajů rank: <?php echo $data['rank_name_en']; ?></h1>
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
            <input type="text" name="id" value="<?php echo $data['rank_id']; ?>" disabled>
        </div>
        <div>
            <label>rank cz </label>
            <input type="text" name="rankcz" value="<?php echo $data['rank_name_cs']; ?>">
        </div>
        <div>
            <label>rank en: </label>
            <input type="text" name="ranken" value="<?php echo $data['rank_name_en']; ?>">
        </div>
        <div>
            <label>rank protected</label>
            <input id="phone" name="protected" class="no-arrow" value="<?php echo $data['rank_protected']; ?>" type="number" disabled>
        </div>
        <button type="submit" class="btn btn-primary" name="update">Update rank</button>
    <?php } ?>
    </form>