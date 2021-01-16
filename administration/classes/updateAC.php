<?php
require_once('../config/config.php');


$id = $_GET['id'];
if (isset($_POST['update'])) {
    $email = strip_tags($_REQUEST['email']);
    $fullname = strip_tags($_REQUEST['fullname']);
    $telefon = strip_tags($_REQUEST['telefon']);
    $republika = strip_tags($_REQUEST['republika']);
    $rank = strip_tags($_REQUEST['rank']);
    $ulice = strip_tags($_REQUEST['ulice']);
    $mesto = strip_tags($_REQUEST['mesto']);
    $psc = strip_tags($_REQUEST['psc']);

    try {
        $select_stmt = $db->prepare("SELECT account_mail FROM accounts 
        WHERE account_mail=:email");

        $select_stmt->execute(array(':email' => $email));
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        if (!isset($errorMsg)) {

            $insert_stmt = $db->prepare("UPDATE accounts SET `account_name` = :fullname, `account_mail` = :email, `account_rank` = :rank, `account_phone` = :telefon, `account_republika` = :republika,  `account_ulice` = :ulice, `account_mesto` = :ulice, `account_psc` = :psc WHERE `account_id` = $id");

            if ($insert_stmt->execute(array(
                ':email' =>  $email,
                ':fullname' => $fullname,
                ':telefon' => $telefon,
                ':rank' => $rank,
                ':republika' => $republika,
                ':ulice'    => $ulice,
                ':mesto'    => $mesto,
                ':psc'    => $psc,
            ))) {

                header('Location: ../accounts.php');
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
$stmt = $db->prepare("SELECT * FROM `accounts` WHERE `account_id` = $id");
$stmt->execute();
$datas = $stmt->fetchAll();
foreach ($datas as $data) {
?>
    <h1>Změna údajů uživatele: <?php echo $data['account_name']; ?></h1>
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
            <input type="text" name="id" value="<?php echo $data['account_id']; ?>" disabled>
        </div>
        <div>
            <label>Datum registrace </label>
            <input type="datetime" name="datetime" value="<?php echo $data['account_reg_date']; ?>" disabled>
        </div>
        <div>
            <label>email: </label>
            <input type="email" name="email" value="<?php echo $data['account_mail']; ?>">
        </div>
        <div>
            <label>tel. číslo</label>
            <input id="phone" name="telefon" class="no-arrow" value="<?php echo $data['account_phone']; ?>" type="number">
        </div>
        <div>
            <label>Uživatel. rank</label>
            <select name="rank" id="rank">
                <option value="<?php echo $data['account_rank']; ?>">Právě nastaven rank: <?php echo $data['account_rank']; ?></option>
                <option value="1">RANK 3 - běžný uživatel</option>
                <option value="2">RANK 2 - Vidí pouze chat - Moderator</option>
                <option value="3">RANK 1 - Administrator</option>
            </select>
        </div>

        <h1>fakturacni údaje</h1>
        <div>
            <label>Celé jméno / název firmy </label>
            <input type="text" name="fullname" value="<?php echo $data['account_name']; ?>">
        </div>
        <div>
            <label>republika</label>
            <input type="text" name="republika" value="<?php echo $data['account_republika']; ?>">
        </div>
        <div>
            <label>ulice</label>
            <input type="text" name="ulice" value="<?php echo $data['account_ulice']; ?>">
        </div>
        <div>
            <label>Mesto</label>
            <input type="text" name="mesto" value="<?php echo $data['account_mesto']; ?>">
        </div>
        <div>
            <label>PSC</label>
            <input type="text" name="psc" value="<?php echo $data['account_psc']; ?>">
        </div>
        <div>
            <label>ip</label>
            <input type="text" name="ip" value="<?php echo $data['account_ip']; ?>" disabled>
        </div>
        <button type="submit" class="btn btn-primary" name="update">Update uživatele</button>
    <?php } ?>
    </form>