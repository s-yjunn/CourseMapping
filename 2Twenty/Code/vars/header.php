<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>2Twenty Marketplace</title>
    <link rel="stylesheet" href="css/bulma.css">
    <link rel="stylesheet" href="css/twenty.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script type="text/javascript">

    // grey out buttons for items in cart already
    function disableButtons() {
        if(Cookies.get("cart") !== undefined) {
            var cart = Cookies.get("cart").split(",");
            for(var x = 0; x<cart.length; x++) {
                $("#button-cart-"+cart[x]).html('<span class="icon is-small"><i class="fas fa-trash" aria-hidden="true"></i></span><span>Remove from cart</span>');
                $("#button-cart-"+cart[x]).attr("onClick", "removeFromCart("+cart[x]+", this);");
            }
        }
    }

    $(document).ready(function() {
        $(".navbar-burger").click(function() {
            $(".navbar-burger").toggleClass("is-active");
            $(".navbar-menu").toggleClass("is-active");
        });

        $("#login").click(function() { $("#login-modal").toggleClass("is-active"); });
        $("#register").click(function() { $("#register-modal").toggleClass("is-active"); });
        $("#cart").click(function() { $("#cart").toggleClass("is-active"); });

        $("#login-modal > .modal-close").click(function() { $("#login-modal").toggleClass("is-active"); });
        $("#register-modal > .modal-close").click(function() { $("#register-modal").toggleClass("is-active"); });

        $("#good-login > .delete").click(function() { $("#good-login").remove(); });
        $("#bad-login > .delete").click(function() { $("#bad-login").remove(); });
        $("#good-login").draggable();
        $("#bad-login").draggable();

        $("#more").click(function() {
            $("body,html").animate({
                scrollTop: $("#body").offset().top
            }, 300);
        });
        
        disableButtons();
    });

    function clearCart() {
        Cookies.remove("cart");
        location.reload();
    }

    function removeFromCart(item_id, targetButton) {
        var cart = Cookies.get("cart").split(",");
        if(cart.length == 2)
            clearCart();
        else
            Cookies.set("cart", Cookies.get("cart").replace(item_id + ",", ""), {expires:1});
            $(targetButton).html('<span class="icon is-small"><i class="fas fa-cart-plus" aria-hidden="true"></i></span><span>Add to cart cart</span>');
        $(targetButton).attr("onClick", "addToCart("+item_id+", this);");
        location.reload();
    }

    function addToCart(item_id, targetButton) {
        if(Cookies.get("cart") == undefined) 
            Cookies.set("cart", item_id + ",", {expires:1});
        else 
            Cookies.set("cart", Cookies.get("cart") + item_id + ",", {expires:1}); 
            $(targetButton).html('<span class="icon is-small"><i class="fas fa-trash" aria-hidden="true"></i></span><span>Remove from cart</span>');
        $(targetButton).attr("onClick", "removeFromCart("+item_id+", "+targetButton+");");
        location.reload();
    }

    if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
    }
    
    </script>
</head>