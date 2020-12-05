<div class="navbar-item">
    <div class="dropdown" id="cart">
        <div class="dropdown-trigger">
            <button class="button">
                <span class="icon is-small"><i class="fas fa-shopping-cart" aria-hidden="true"></i></span>
                <span>My Cart</span>
            </button>
        </div>
        <div class="dropdown-menu">
            <div class="dropdown-content">
                <span class='dropdown-item'><h2 class='subtitle'>Items in cart</h2></span>
                <hr class='dropdown-divider'>
                <span class='dropdown-item'><!--empty--></span>
                <?php
if (!isset($_COOKIE["cart"]))
{
    echo ("<span class='dropdown-item'>Cart is currently empty.</span>");
}
else
{

    $cart = explode(" ", ($_COOKIE["cart"]));
    foreach ($cart as & $item)
    {
        $name = getItemById($item) [1];
        $price = getItemById($item) [6];

        echo ("<a class='dropdown-item'><strong>$name</strong> &mdash; <span class='tag is-success'>$$price</span></a>");
    }

    echo ("
                            <span class='dropdown-item'><!--empty--></span>
                            <a class='dropdown-item has-text-white has-background-info' onClick='Cookies.remove(\"cart\"); location.reload();'>Clear Cart</a>
                            <a class='dropdown-item has-text-white has-background-danger'>Check Out</a>
                        ");

}
?>
            </div>
        </div>
    </div>
</div>
