<?php
function search_store($desc)
{
    include ("db_connect.php");

    // search by tags, title, description, seller
    // sorted by relevance to title of item
    $sql = "SELECT * FROM `items_for_sale` WHERE tags LIKE CONCAT('%',?,'%') ";
    $sql .= "OR title LIKE CONCAT('%',?,'%') ";
    $sql .= "OR description LIKE CONCAT('%',?,'%') ";
    $sql .= "OR seller LIKE CONCAT('%',?,'%') ";
    $sql .= "ORDER BY (CASE WHEN title LIKE CONCAT('%',?,'%') THEN 1 ELSE 0 END) DESC;";

    $query = $conn->prepare($sql);
    $query->bind_param('sssss', $d, $d, $d, $d, $d);

    $d = $desc;
    $query->execute();

    $res = $query->get_result();

    while ($row = $res->fetch_all())
    {
        return $row;
    }
}
?>
