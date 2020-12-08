<!DOCTYPE html>
<html>
<?php
include("vars/header.php");
include("vars/navbar.php");

$_GET['id'] = (isset($_GET['id']) ? $_GET['id'] : 0);
$item       = ((getItemById($_GET["id"])));
?>

    <body>
        <section class="section" id="body">
            <div class="container">
                <div class="columns">
                <?php
$id        = $item[0];
$title     = $item[1];
$image_url = $item[2];
$tags      = explode(", ", $item[3]);
$desc      = $item[4];
$seller    = $item[5];
$price     = $item[6];

echo ('
                            <div class="column is-4">
                                <div class="card">
                                    <div class="card-image">
                                        <figure class="image is-256x256"><img src="' . $image_url . '" title="' . $image_url . '"></figure>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-4">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="media">
                                            <div class="media-content">
                                                <p class="title is-4">' . $title . ' <span class="tag is-success">$' . $price . '</span></p>
                                                <p class="subtitle is-6">Sold by <a href="user.php?id=' . getUserId($seller) . '">' . $seller . '</a></p>
                                                <strong>Associated Tags</strong>:');

foreach ($tags as &$tag) {
    echo (' <a href="search.php?desc=' . $tag . '"><span class="tag is-danger"><span class="icon"><i class="fas fa-tag"></i></span>&nbsp;' . $tag . '</span></a> ');
}
echo ('
                                            <br/><br/>
                                            <div class="notification is-light">' . $desc . '</div>
                                            <hr class="divider">
                                            <button class="button is-info" id="button-cart-' . $id . '" onClick=\'addToCart("' . $id . '", this);\'>
                                                <span class="icon is-small"><i class="fas fa-cart-plus" aria-hidden="true"></i></span>
                                                <span>Add to cart</span>
                                            </button>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ');

?>
               </div>
            </div>
        </section>
        <?php
include("vars/footer.php");
?>
   </body>

</html>