<!DOCTYPE html>
<html>
<?php
include("vars/header.php");
include("vars/navbar.php");

if (!isset($_COOKIE["cart"])) {
    $cart = NULL;
} else {
    $cart = explode(",", ($_COOKIE["cart"])); 
    array_pop($cart); // get rid of blank entry
    $_SESSION["old_cart"] = $cart;
}

if(isset($_POST["checkout"])) {
    include("src/db_connect.php");
    foreach ($_SESSION["old_cart"] as &$i) {
        $sql   = "DELETE FROM `items_for_sale` WHERE id = ?;";
        $query = $conn->prepare($sql);
        $query->bind_param('i', $id);

        $id = $i;
        $query->execute();
        $result = $query->get_result();
    }
    notifyGood("Successful order!");
    unset($_SESSION["old_cart"]);
}
?>

    <body>
        <section class="section" id="body">
            <div class="container">
                <h1 class="title">Review your order</h1>   
                <p class="subtitle mt-4 is-4">Your Cart</p>
                <?php
                if($cart) {
                    foreach ($cart as &$i) {
                        $item = getItemById($i);
                        $id        = $item[0];
                        $title     = $item[1];
                        $image_url = $item[2];
                        $desc      = $item[4];
                        $seller    = $item[5];
                        $price     = $item[6];
                        echo ('
                                                    <div class="column is-full-mobile is-half">
                                                        <div class="box">
                                                            <article class="media">
                                                                <div class="media-left is-hidden-mobile">
                                                                    <figure class="image is-64x64">
                                                                        <img src="' . $image_url . '" title="' . $image_url . '">
                                                                    </figure>
                                                                </div>
                                                                <div class="media-content">
                                                                    <div class="content">
                                                                        <p>
                                                                            <strong><a href="item.php?id=' . $id . '">' . $title . '</a></strong><br/> for <span class="tag is-success">$' . $price . '</span>
                                                                        </p>
                                                                        <div class="notification is-light">' . $desc . '<br/>
                                                                            <button class="button is-info mt-4" id="button-cart-' . $id . '" onClick=\'addToCart("' . $id . '", this);\'>
                                                                                <span class="icon is-small"><i class="fas fa-cart-plus" aria-hidden="true"></i></span>
                                                                                <span>Add to cart</span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </article>
                                                        </div>
                                                    </div>
                                                    ');
                    }
                    echo('
                                                    <p class="subtitle mt-4 is-4">Payment & Shipping</p>
                                                    <form method="POST">
                                                        <div class="columns">
                                                            <div class="column is-one-third">
                                                                <div class="control has-icons-left">
                                                                    <input class="input mt-1" type="text" name="cardholder" placeholder="Cardholder Name">
                                                                    <span class="icon is-small is-left">
                                                                            <i class="fas fa-user"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="control has-icons-left">
                                                                    <input class="input mt-1" type="text" name="cc" maxlength="128" placeholder="Credit/Debit Card #">
                                                                    <span class="icon is-small is-left">
                                                                            <i class="fas fa-credit-card"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="column is-one-fifth">
                                                                <div class="control has-icons-left">
                                                                    <input class="input mt-1" type="text" name="cvc" placeholder="CVC">
                                                                    <span class="icon is-small is-left">
                                                                            <i class="fas fa-lock"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="control has-icons-left">
                                                                    <input class="input mt-1" type="text" name="expire" placeholder="MM / YYYY">
                                                                    <span class="icon is-small is-left">
                                                                            <i class="fas fa-calendar"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input class="button is-danger is-outlined mt-2" type="submit" name="checkout" value="Submit Order" onClick="Cookies.remove(\'cart\'); location.reload();">
                                                        ');
                } else {
                    echo("<p>Cart is empty.</p>");
                }
                ?>
                </form>
            </div>
        </section>
        <?php
include("vars/footer.php");
?>
   </body>

</html>