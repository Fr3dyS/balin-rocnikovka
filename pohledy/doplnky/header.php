<div class="bs-example">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <a href="index.php" class="navbar-brand"><?php echo $lang['title']; ?></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <?php
            require_once 'config/configDB.php';

            if (isset($_SESSION['user_login'])) {

                $id = $_SESSION['user_login'];

                $select_stmt = $db->prepare("SELECT * FROM accounts WHERE account_id=:uid");
                $select_stmt->execute(array(":uid" => $id));

                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            }


            ?>
            <div class="navbar-nav">
                <a href="index.php" class="nav-item nav-link "><?php echo $lang['uvod'];  ?></a>
                <a href="cenik.php" class="nav-item nav-link "><?php echo $lang['cenik'];  ?></a>
                <a href="aboutUs.php" class="nav-item nav-link "><?php echo $lang['oNas'];  ?></a>
                <a href="produkty.php" class="nav-item nav-link "><?php echo $lang['produkty'];  ?></a>
                <a href="kontakt.php" class="nav-item nav-link "><?php echo $lang['kontakt'];  ?></a>
            </div>
            <div class="navbar-nav ml-auto">
                <?php if (!isset($_SESSION['user_login'])) { ?>
                    <a href="login.php" class="nav-item nav-link "><?php echo $lang['login']; ?></a>
                <?php } ?>
                <?php if (isset($_SESSION['user_login'])) { ?>
                    <div class="btn-group dropleft">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $lang['accountDetails'];  ?>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="account.php"><?php echo $lang['account']; ?></a>
                            <a class="dropdown-item" href="administration/index.php"><?php echo $lang['administrativa']; ?></a>
                            <a class="dropdown-item" href="logout.php"><?php echo $lang['logout']; ?></a>

                        </div>
                    </div>

                <?php } ?>
            </div>
            <?php
            /***
             * lang vyber
             */
            ?>
            <div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $lang['langchoice']?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="config/lang.php?lang=cs">cz</a>
                        <a class="dropdown-item" href="config/lang.php?lang=en">en</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
