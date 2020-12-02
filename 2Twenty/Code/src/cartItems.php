<?php
function show_cart($uname)
{
    include ("db_connect.php");

    // search by seller
    $sql = "SELECT * FROM `user` WHERE user LIKE CONCAT(?); ";

    $query = $conn->prepare($sql);
    $query->bind_param('s', $u);

    $u = $uname;
    $query->execute();

    $res = $query->get_result();

    while ($row = $res->fetch_all())
    {
        //store all items of 'cart' column
        $items = $row[5];
    }

    // return items with those IDs

    //items array as string
    $string="$items";
    $array=array_map('intval', explode(',', $string));
    $array = implode("','",$array);

    //SQL statement that selects all items with ID numbers in that array
    $sql = "SELECT * FROM `items_for_sale` WHERE id IN ('".$array."');";

    $query = $conn->prepare($sql);

    $query->execute();

    $res = $query->get_result();

    while ($row = $res->fetch_all())
    {
        return $row;
    }




}
?>
