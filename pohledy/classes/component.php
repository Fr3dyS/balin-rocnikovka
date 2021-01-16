<?php

function component($productname, $productprice, $productimg, $productid)
{
    $element = "
    
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
                <form action=\"index.php\" method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                            <img src=\"$productimg\" alt=\"Image1\" class=\"img-fluid card-img-top\">
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$productname</h5>
                            <h6>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"far fa-star\"></i>
                            </h6>
                            <p class=\"card-text\">
                                Some quick example text to build on the card.
                            </p>
                            <h5>
                                <small><s class=\"text-secondary\">$519</s></small>
                                <span class=\"price\">$$productprice</span>
                            </h5>

                            <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                             <input type='hidden' name='product_id' value='$productid'>
                        </div>
                    </div>
                </form>
            </div>
    ";
    echo $element;
}


function cartElement($productimg, $productname, $productprice, $productid)
{
    $element = "

    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <small class=\"text-secondary\">Seller: dailytuition</small>
                                <h5 class=\"pt-2\">$$productprice</h5>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                            <div class=\"col-md-3 py-5\">
                                <div>
                                    <input type=\"number\" min=\"1\" value=\"1\" class=\"form-control w-25 d-inline\" onchange=\"updateInput(value)\">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
}

function selectDoprava($id, $nazev, $cena)
{
    $element = "

    <table>
        <tr>
            <th>reakce</th>
            <th>name</th>
            <th>price</th>
        </tr>
        <tr>
            <td><input type=\"radio\" name=\"options\" id=\"option1\" autocomplete=\"off\"></td>
            <td>$nazev</td>
            <td>$cena</td>
        </tr>
    </table>
    ";

    echo $element;
}
function selectPlatba($id, $nazev, $cena)
{
    $element = "
    <table>
        <tr>
            <th>reakce</th>
            <th>name</th>
            <th>price</th>
        </tr>
        <tr>
            <td><input type=\"radio\" name=\"options\" id=\"option1\" autocomplete=\"off\"></td>
            <td>$nazev</td>
            <td>$cena</td>
        </tr>
    </table>
    ";

    echo $element;
}
function cart3($name, $email)
{
    $element = "
    <div>
        <div>
            <h1>$name</h1>
            <h2>$email</h2>
        </div>
        <div>
            <h1>Fakturační udaje</h1>
            <button onclick=\"myFunction()\">CHANGE</button>
        </div>
    </div>
    ";
    echo $element;
}
function changeCart3($jmeno, $email, $phone, $republika, $ulice, $mesto, $psc)
{
    $element = "
<form method=\"POST\" id=\"test\">
    <div class=\"form-group row\">
        <label for=\"inputEmail3\" class=\"col-sm-2 col-form-label\">Jméno a Příjmení</label>
        <div class=\"col-sm-10\">
            <input type=\"text\" class=\"form-control\" id=\"inputEmail3\" placeholder=\"Jméno a příjmení\" value=\"$jmeno\">
        </div>
    </div>
    <div class=\"form-group row\">
        <label for=\"inputEmail3\" class=\"col-sm-2 col-form-label\">Email</label>
        <div class=\"col-sm-10\">
            <input type=\"text\" class=\"form-control\" id=\"inputEmail3\" placeholder=\"Email\" value=\"$email\">
        </div>
    </div>
    <div class=\"form-group row\">
        <label for=\"inputEmail3\" class=\"col-sm-2 col-form-label\">phone</label>
        <div class=\"col-sm-10\">
            <input type=\"text\" class=\"form-control\" id=\"inputEmail3\" placeholder=\"Mobil\" value=\"$phone\">
        </div>
    </div>
    <div class=\"form-group row\">
        <label for=\"inputEmail3\" class=\"col-sm-2 col-form-label\">republika</label>
        <div class=\"col-sm-10\">
            <input type=\"text\" class=\"form-control\" id=\"inputEmail3\" placeholder=\"Republika\" value=\"$republika\">
        </div>
    </div>
    <div class=\"form-group row\">
        <label for=\"inputEmail3\" class=\"col-sm-2 col-form-label\">ulice</label>
        <div class=\"col-sm-10\">
            <input type=\"text\" class=\"form-control\" id=\"inputEmail3\" placeholder=\"Ulice\" value=\"$ulice\">
        </div>
    </div>
    <div class=\"form-group row\">
        <label for=\"inputEmail3\" class=\"col-sm-2 col-form-label\">mesto</label>
        <div class=\"col-sm-10\">
            <input type=\"text\" class=\"form-control\" id=\"inputEmail3\" placeholder=\"Mesto\" value=\"$mesto\">
        </div>
    </div>
    <div class=\"form-group row\">
        <label for=\"inputEmail3\" class=\"col-sm-2 col-form-label\">PSC</label>
        <div class=\"col-sm-10\">
            <input type=\"text\" class=\"form-control\" id=\"inputEmail3\" placeholder=\"PSC\" value=\"$psc\">
        </div>
    </div>
</form>
    ";

    echo $element;
}
?>

<script>
    function updateInput(ish) {
        document.getElementById("test").value = ish;
    }

    function myFunction() {
        var x = document.getElementById("test");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>