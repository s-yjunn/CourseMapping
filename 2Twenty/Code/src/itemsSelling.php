<?php
function search_selling($uname)
{
    include ("db_connect.php");

    // search by seller
    $sql = "SELECT * FROM `items_for_sale` WHERE seller LIKE CONCAT('%',?,'%'); ";

    $query = $conn->prepare($sql);
    $query->bind_param('s', $u);

    $u = $uname;
    $query->execute();

    $res = $query->get_result();

    while ($row = $res->fetch_all())
    {
        return $row;
    }
}
?>
