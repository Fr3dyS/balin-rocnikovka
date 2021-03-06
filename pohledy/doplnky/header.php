<style>
    .dark-mode {
        background-color: black;
        color: white;
    }
</style>
<?php
global $cart_data;

if (isset($_SESSION['product_cart']) && !empty($_SESSION['product_cart'])) {
    $cart_data = $_SESSION['product_cart'];
}

?>
<script>
    function changeLang() {
        document.getElementById('form_lang').submit();
    }
</script>
<div class="bs-example">
    <nav class="navbar navbar-expand-md">
        <a href="index.php" class="navbar-brand"><?php echo $lang['title']; ?></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <?php
            require_once 'config/configDB.php';


            if (isset($_COOKIE["login"])) {

                $id = $_COOKIE["login"];

                $select_stmt = $db->prepare("SELECT * FROM accounts WHERE account_id=$id");
                $select_stmt->execute(array(":uid" => $id));

                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <div class="navbar-nav">
                <a href="aboutUs.php" class="nav-item nav-link "><?php echo $lang['oNas'];  ?></a>
                <a href="produkty.php" class="nav-item nav-link "><?php echo $lang['produkty'];  ?></a>
                <a href="kontakt.php" class="nav-item nav-link "><?php echo $lang['kontakt'];  ?></a>
            </div>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="mr-auto"></div>
                <div class="navbar-nav">
                    <a href="cart.php" class="nav-item nav-link active">
                        <h5 class="px-5 cart">
                            <i class="fas fa-shopping-cart"></i> <?php echo $lang['Cart'];  ?>
                            <span class="badge badge-danger"><?php echo @count($cart_data); ?></span>
                        </h5>
                    </a>
                </div>
            </div>
            <div class="navbar-nav ml-auto">
                <?php if (!isset($_COOKIE["login"])) { ?>
                    <a href="login.php" class="nav-item nav-link "><?php echo $lang['login']; ?></a>
                <?php } ?>
                <?php if (isset($_COOKIE["login"])) { ?>
                    <div class="btn-group dropleft">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $lang['accountDetails'];  ?>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="account.php"><?php echo $lang['account']; ?></a>
                            <?php if ($row['account_rank'] == 3) {
                            ?> <a class="dropdown-item" href="administration/index.php"><?php echo $lang['administrativa']; ?></a><?php
                                                                                                                                } ?>
                            <a class="dropdown-item" href="logout.php"><?php echo $lang['logout']; ?></a>

                        </div>
                    </div>

                <?php } ?>
            </div>
            <button onclick="myFunction()">Tmavý režim</button>
            <!-- Language -->
            <form method='get' action='' id='form_lang'>
                <?php echo $lang['vyberJazyk'];  ?>
                <select name='lang' onchange='changeLang();'>
                    <option value='en' <?php if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') {
                                            echo "selected";
                                        } ?>> <?php echo $lang['EnglishChoose'];  ?></option>
                    <option value='cs' <?php if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'cs') {
                                            echo "selected";
                                        } ?>> <?php echo $lang['CestinaChoose'];  ?></option>
                </select>
            </form>
        </div>
    </nav>
</div>
<script>
    function myFunction() {
        var element = document.body;
        element.classList.toggle("dark-mode");
    }
</script>