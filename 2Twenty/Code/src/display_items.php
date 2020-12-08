<?php
function display_items($results)
{
    if ($results) {
        foreach ($results as &$item) {
            $id        = $item[0];
            $title     = $item[1];
            $image_url = $item[2];
            $tags      = explode(", ", $item[3]);
            $desc      = $item[4];
            $seller    = $item[5];
            $price     = $item[6];
            
            echo ('
                                        <div class="column is-full-mobile is-half">
                                            <div class="box">
                                                <article class="media">
                                                    <div class="media-left is-hidden-mobile">
                                                        <figure class="image is-128x128">
                                                            <img src="' . $image_url . '" title="' . $image_url . '">
                                                        </figure>
                                                    </div>
                                                    <div class="media-content">
                                                        <div class="content">
                                                            <p>
                                                                <strong><a href="user.php?id=' . getUserId($seller) . '">' . $seller . '</a></strong> is selling <strong><a href="item.php?id=' . $id . '">' . $title . '</a></strong> for <span class="tag is-success">$' . $price . '</span>
                                                                <br/>
                                                                <div class="notification is-light">' . $desc . '<br/>
                                                                
                                        ');
            
            foreach ($tags as &$tag) {
                echo (' <a href="search.php?desc=' . $tag . '"><span class="tag is-danger"><span class="icon"><i class="fas fa-tag"></i></span>&nbsp;' . $tag . '</span></a> ');
            }
            
            echo ('
                                                                    <br/>
                                                                    <button class="button is-info mt-4" id="button-cart-' . $id . '" onClick=\'addToCart("' . $id . '", this);\'>
                                                                        <span class="icon is-small"><i class="fas fa-cart-plus" aria-hidden="true"></i></span>
                                                                        <span>Add to cart</span>
                                                                    </button> 
                                                                </div>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                        ');
        }
    } else {
        echo ('<p class="subtitle m-4">No items to display.</p>');
    }
}

function getItemById($id)
{
    
    include("db_connect.php");
    
    $sql   = "SELECT * FROM `items_for_sale` WHERE id = ?;";
    $query = $conn->prepare($sql);
    $query->bind_param('i', $i);
    
    $i = $id;
    $query->execute();
    $result = $query->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_array();
    } else {
        return "Unknown Item";
    }
    
}

?>