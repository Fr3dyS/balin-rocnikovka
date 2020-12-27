<script>
    function changeLang() {
        document.getElementById('form_lang').submit();
    }
</script>
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="navbar-nav">
        <ul class="navbar-nav">
            <div class="btn-group dropright">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $lang['users'];  ?>
                </button>
                <div class="dropdown-menu">
                    <div><a href="accounts.php">Účty</a></div>
                    <div><a href="ranks.php">Ranks</a></div>
                </div>
            </div>
            <div class="btn-group dropright">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $lang['Eshop'];  ?>
                </button>
                <div class="dropdown-menu">
                    <div> <a href="objednavky.php">objednavky</a></div>
                    <div><a href="produkty.php">Produkty</a></div>
                    <div><a href="kupony.php">Kupony</a></div>
                    <div><a href="methods.php">Platebni metody</a></div>
                </div>
            </div>
    </div>
    <div class="btn-group dropright">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $lang['Kity'];  ?>
        </button>
        <div class="dropdown-menu">
            <li>gdighi</li>
        </div>
    </div>
    <div class="btn-group dropright">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $lang['test'];  ?>
        </button>
        <div class="dropdown-menu">
            <li>gdighi</li>
        </div>
    </div>
    <div class="btn-group dropright">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $lang['Zpet'];  ?>
        </button>
        <div class="dropdown-menu">
            <a href="./../index.php"> <?php echo $lang['Zpet'];  ?></a>
        </div>
    </div>
    </ul>
    </div>
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
</nav>